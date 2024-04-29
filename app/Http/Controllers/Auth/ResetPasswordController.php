<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Auth;
use Illuminate\Http\Request;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin';


    public function __construct(Request $request) {
        $user =  User::where('email',$request->email)->first();

        // if($user->role == 2){
        //     header("Location: ". url('/employees/home'));
        //     exit();
        // }else if($user->role == 3){
        //     $redirectTo = '/';
        // }else{
        //     header("Location: ". url('/admin/home'));
        //     exit();
        // }
    }
    

}
