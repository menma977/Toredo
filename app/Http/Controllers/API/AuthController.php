<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Binary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

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

        $createAccount = Http::asForm()->post('link doge', [ //link
            'a' => 'CreateAccount',
            'Key' => 'key', //key
        ]);
        $getWallet = Http::asForm()->post('link doge', [    //link
            'a' => 'GetDepositAddress',
            's' => $createAccount->json()['SessionCookie'],
            'Currency' => "doge"
        ]);
        $createUser = Http::asForm()->post('link doge', [   //link
            'a' => 'CreateUser',
            's' => $createAccount->json()['SessionCookie'],
            'Username' => $usernameDoge,
            'Password' => $passwordDoge,
        ]);

        //cek sponsor
        $idSponsor = User::where('username', $request->sponsor)->first()->id;
        $binary = Binary::where('user', $idSponsor)->orWhere('sponsor', $idSponsor)->first();
    }
}
