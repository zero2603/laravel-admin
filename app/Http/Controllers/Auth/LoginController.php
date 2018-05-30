<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
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
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    // protected $redirectTo = '/home';
    // protected function authenticated(Request $request, $user)
    // {
    //     if ( Auth::user()->enable == 0 ) {
    //         return redirect()->route('home');
    //     } else if (Auth::user()->role == 1 && Auth::user()->enable == 1) {
    //         return redirect('/admin/dashboard');
    //     }

    //     return redirect('/dashboard');
    // }

    public function authenticated(Request $request, $user)
    {
        if (!$user->verified) {
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        } else {
            if ( $user->enable == 0 ) {
                return redirect()->route('home');
            } else if ($user->role == 1 && $user->enable == 1) {
                return redirect('/admin/dashboard');
            }

            return redirect('/dashboard');
        }
        return redirect()->intended($this->redirectPath());
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
