<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DogeController;
use App\Models\Binary;
use App\Models\Doge;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;


class RegisteredUserController extends Controller
{
    /**
     * Registration default
     *
     * @return View/register
     */

    public function create()
    {
        return view('auth.register');
    }

    /**
     *Registration with referral
     *
     * @param $voucher
     * @return View/Register-voucher
     */
    public function createWithVoucher($voucher)
    {
        $data = [
            "voucher" => $voucher,
        ];
        return view('auth.register-voucher', $data);
    }


    /**
     * Process registration request
     *
     * @param Request $request
     * @return RedirectResponse
     *
     * @throws Exception
     *
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'sponsor' => 'required|string|exists:users,code',
                'name' => 'required|string',
                'username' => 'required|string|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|same:confirmation_password|min:6',
            ]
        );

        $dogeAccount = $this->makeWallet();
        if ($dogeAccount->code != 200) {
            return back()->with(["error" => $dogeAccount->message]);
        }


        $user = new User();
        $user->username = $request->inpput('username');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $doge = new Doge();
        $doge->user_id = $user->id;
        $doge->username = $dogeAccount->data->username;
        $doge->password = $dogeAccount->data->password;
        $doge->wallet = $dogeAccount->data->wallet;
        $doge->cookie = $dogeAccount->data->cookie;

        $binary = new Binary();
        if ($request->has('sponsor')) {
            $upline = User::where("username", $request->input("sponsor"))->first();
            $binary->sponsor = $upline->id;
        } else {
            $binary->sponsor = 1;
        }

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }


    /**
     * Creating wallet on 999dice
     * @return object
     * @throws Exception
     */
    public function makeWallet(): object
    {
        $accountCookie = DogeController::createAccount();
        if ($accountCookie->code != 200) {
            return (object)[
                "code" => 500,
                "message" => $accountCookie->message,
                "data" => [],
            ];
        }

        $accountCookie = DogeController::wallet($accountCookie->data->cookie);
        if ($accountCookie->code != 200) {
            return (object)[
                "code" => 500,
                "message" => $accountCookie->message,
                "data" => []
            ];
        }

        $usernameCoin = DogeController::randomAccount();
        $passwordCoin = DogeController::randomAccount();

        $createUser = DogeController::createUser($accountCookie->data->cookie, $usernameCoin, $passwordCoin);
        if ($createUser->code != 200) {
            return (object)[
                "code" => 500,
                "message" => $createUser->message,
                "data" => []
            ];
        }

        return (object)[
            "code" => 200,
            "message" => " succesfully created",
            "data" => (object)[
                "username" => $usernameCoin,
                "password" => $passwordCoin,
                "wallet" => $accountCookie->data->wallet,
                "cookie" => $accountCookie->data->cookie,
            ]
        ];
    }
}
