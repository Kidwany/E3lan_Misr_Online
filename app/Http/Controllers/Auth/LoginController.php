<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/e3lan-misr-admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    
    
    
        public function login(Request $request)
    {


          $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
             ]);

            if($validator->fails()) {

                return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator, 'error');
                }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'custom_id' => 1,'verified'=>1])) {
            return redirect()->route('e3lan-misr-admin')->with('message', 'This account activated !');
        }  else {
            return redirect()->route('login')->with('error', 'This account is not activated !');
        }

    }

    
}
