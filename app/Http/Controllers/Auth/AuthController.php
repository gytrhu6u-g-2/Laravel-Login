<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        // Userのemailに$credentialsのemailを引き出す。存在しない場合はnull
        $user = User::where('email', '=', $credentials['email'])->first();

        if (!is_null($user)) {
            // locked_flgが1か判断する
            if ($user->locked_flg === 1) {
                return back()->withErrors(
                    [
                        'login_error' => 'アカウントがロックされています。'
                    ]
                    );
            }

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                // userのerror_countが0より大きい場合
                if ($user->error_count > 0) {
                    $user->error_count = 0;
                    $user->save();
                }
    
                return redirect(route('home'))->with('login_success','ログイン成功しました！');
            }
        }

        // パスワードが間違っていた場合、error_countを+1する
        $user->error_count = $user->error_count + 1;
        // error_countが5より大きい場合
        if ($user->error_count > 5) {
            $user->locked_flg = 1;
            $user->save();
            return back()->withErrors(
                [
                    'login_error' => 'アカウントがロックされました。解除したい場合は運営に問い合わせてください。'
                ]
                );
        }
        $user->save();

        return back()->withErrors(
            [
                'login_error' => 'メールアドレスかパスワードが間違っています。'
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
