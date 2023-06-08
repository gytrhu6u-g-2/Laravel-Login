<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    /**
     * @return view
     */
    public function showLogin()
    {
        return view('login.login_form');
    }

    /**
     * ログイン機能
     * @param App\Http\Requests\LoginFormRequest $request
     */
    public function login(LoginFormRequest $request)
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required']
            ],
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect(route('home'))->with('login_success','ログイン成功しました！');
        }

        return back()->withErrors(
            [
                'login_error' => 'メールアドレスかパスワードが間違っています、'
            ]
            );
    }

    /**
     * ログアウト機能
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login.show'))->with('login_success', 'ログアウトしました！');
    }


}
