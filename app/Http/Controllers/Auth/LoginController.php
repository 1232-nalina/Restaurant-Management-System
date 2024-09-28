<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;


    public function showLoginForm(Request $request)
    {
        return view('Backend.auth.login');
    }
    public function login(Request $request)
    {
       //validate login data
        $request->validate([
            'email'=>'required|email|max:50',
            'password'=>'required',
        ]);

       //Attempt to login

       if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember))
       {
        session()->flash('success','successfully logged in');
        return redirect()->intended(route('dashboard'));
       }
       else {
        session()->flash('error','Invalid username & password');
        return back();
       }
    }

    public function logout()
    {

        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');

    }
}
