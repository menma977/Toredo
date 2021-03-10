<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Binary;
use App\Models\Doge;
use App\Models\User;
use App\Notifications\PasswordReset;
use App\Notifications\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|string|email',
            'password' => 'required|min:6',
        ]);

        if (!User::where('username', $request->sponsor)->first()->active) {
            return response()->json(['message' => 'Your sponsor is not active'], 500);
        }

        $usernameDoge = $this->generateRandomString();
        $passwordDoge = $this->generateRandomString();

        $createAccount = Http::asForm()->post('url doge', [ //url
            'a' => 'CreateAccount',
            'Key' => 'key', //key
        ]);
        $getWallet = Http::asForm()->post('url doge', [    //url
            'a' => 'GetDepositAddress',
            's' => $createAccount->json()['SessionCookie'],
            'Currency' => "doge"
        ]);
        $createUser = Http::asForm()->post('url doge', [   //url
            'a' => 'CreateUser',
            's' => $createAccount->json()['SessionCookie'],
            'Username' => $usernameDoge,
            'Password' => $passwordDoge,
        ]);

        if ($createUser->json()['success'] == 1) {
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $doge = new Doge();
            $doge->user_id = $user->id;
            $doge->username = $usernameDoge;
            $doge->Password = $passwordDoge;
            $doge->wallet = $getWallet->json()['Address'];
            $doge->cookie = $createAccount->json()['SessionCookie'];
            $doge->save();

            $getSponsor = User::where('username', $request->sponsor)->first();
            $binary = new Binary();
            if ($getSponsor) {
                $binary->sponsor = $getSponsor->id;
            } else {
                $binary->down_line = $getSponsor->id;
            }
            $binary->save();

            $description = "your account creation is successful. with username: " . $user->username .
                ". Please login and complete your account activation";

            Notification::send($user, new Registered($user));

            return response()->json([
                'message' => 'Registration Success',
                'user' => $description
            ], 200);
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            foreach (Auth::user()->tokens as $value) {
                $value->delete();
            }
            $user = Auth::user();

            $doge_login = Http::asForm()->post('https://www.999doge.com/api/web.aspx', [
                'a' => 'Login',
                'Key' => 'f3023b66b9304852abddc71ccd8237e9',
                'username' => $user->username_doge,
                'password' => $user->password_doge
            ]);

            if ($doge_login->successful()) {
                $res = $doge_login->json();
                if (array_key_exists('InvalidApiKey', $res)) {
                    return response()->json([
                        'message' => 'access token invalid'
                    ], 500);
                }
                if (array_key_exists('LoginInvalid', $res)) {
                    return response()->json([
                        'message' => 'Invalid username or password'
                    ], 400);
                }
                $user->token_doge = $res["SessionCookie"];
                $user->save();
            }

            return response()->json([
                'message' => 'Invalid username or password or too many logins'
            ], 400);
        }

        return response()->json([
            'message' => 'Invalid username or password'
        ], 400);
    }

    public function forgotPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|exists:user,email'
        ]);

        $user = User::where('email', $request->input('email'))->first();
        Notification::send($user, new PasswordReset($user));

        return response()->json(['message' => 'passwords are sent via email and phone. make sure your email and phone are active'], 200);
    }

    public function logout()
    {
        $token = Auth::user()->tokens;

        foreach ($token as $key => $value) {
            $value->delete();
        }

        return response()->json([
            'response' => 'Successfully logged out',
        ], 200);
    }
}
