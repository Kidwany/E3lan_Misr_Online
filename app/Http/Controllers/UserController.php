<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->activation_code = str_random(8);
        $user->password = Hash::make($request['password']);
        $user->custom_id = 0;
        $user->save();

        $user->sendActivationMail();

      Session::flash("registermessage", "Success register,  check your mail to activation accout ");
        // dd($user->sendActivationMail());
        return redirect()->back();
    }

    public function verify($activation_code)
    {

            $customer = User::where('activation_code', '=', $activation_code)->first();

            if (!$customer) {
                return redirect()->route('home');
            } else {
                $customer->verified = 1;
                $customer->activation_code = null;
                $customer->save();

                if (app()->getLocale() == "en") {
                    Session::flash("registermessage", "Success activation, " . $customer->name);
                } else {
                    Session::flash("registermessage", "تم تفعيل حسابك بنجاح " . $customer->name);
                }

                return redirect()->route('login/customer');
            }


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

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'custom_id' => 0,'verified'=>1])) {

            return redirect()->route('homepage')->with('message', 'This account activated !');
        }  else {

            return redirect()->route('login.customer')->with('error', 'This account is not activated !');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');

    }

    public function loginPage()
    {
        return view('website.login');
    }
}
