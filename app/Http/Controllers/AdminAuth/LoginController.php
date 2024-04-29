<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    static private $acceptedUserTypes = ['Admin'];

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    // public $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function authenticated($request, $user)
    {
        if (in_array($user->user_type, self::$acceptedUserTypes)) {
            if ($request->post('remember') != Null) {
                $lifetime = time() + 60 * 60 * 24 * 365; // one year
                Cookie::queue('rememberChecked', 'on', $lifetime);
            } else {
                Cookie::queue(Cookie::forget('rememberChecked'));
            }
            return redirect('admin/reports');
        } else {
            return redirect('admin/login')->withErrors(__('auth.failed'));
        }
    }

    public function login(Request $request)
    {
        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$field => $request->input('email')]);
        $user_type = User::where('email', $request->input('email'))->first()->role ?? null;
        if (in_array($user_type, self::$acceptedUserTypes) && Auth::attempt($request->only($field, 'password'))) {

            return redirect('/admin');
        }

        return redirect('/admin/login')->withErrors([
            'error' => 'These credentials do not match our records.',
        ])->withInput($request->only('email', 'remember'));
    }



    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
    }
}
