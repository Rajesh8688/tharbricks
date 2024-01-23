<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('front_end.auth.login');
    }
     /**
     * Get the needed authorization credentials from the request.
     * Adding back_end_user = 0(front end users) extra condition to login request
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        //dd(array_merge($request->only($this->username(), 'password'), ['back_end_user' => 0,'status' => 'Active']));
        //dd($request);
        $remember = $request->has('remember') ? true : false; 
        //dd($request->only($this->username(), 'password' ,'remember_me'));
       



        return array_merge($request->only($this->username(), 'password'), ['back_end_user' => 0,'status' => 'Active']);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function admin()
    {
        if(Auth::guard('admin')->check())
        {
            return redirect('admin/dashboard');
        }
        else{
            return redirect('admin/login');
        }
    }
}
