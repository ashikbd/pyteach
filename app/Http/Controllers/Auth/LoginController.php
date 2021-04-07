<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:parents')->except('logout');
        $this->middleware('guest:students')->except('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {

        if($request->input('user_type') == 'student'){
            if (Auth::guard('students')->attempt(['email' => $request->email, 'password' => $request->password], 0)) {
                $this->redirectTo = '/students/dashboard';
                return true;
            }
        }elseif($request->input('user_type') == 'parent'){
            if (Auth::guard('parents')->attempt(['email' => $request->email, 'password' => $request->password], 0)) {
                $this->redirectTo = '/parents/dashboard';
                return true;
            }
        }elseif($request->input('user_type') == 'admin'){
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], 0)) {
                $this->redirectTo = '/admin/dashboard';
                return true;
            }
        }

    }

    protected function authenticated(Request $request, $user)
    {
        $request->session()->flash('success', 'You have logged in successfully!');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $request->session()->flash('error', 'User credential did not match. Please try again!');
        return redirect()->back();
    }

    public function secureLogin()
    {
        return view('auth.admin_login');
    }
}
