<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
{
    public function gate(){
        $check = Auth::check();

        if($check){
            return redirect()->route('dashboard.index');
        }else{
            return redirect()->route('login.index');
        }
    }

    public function index(){
        $check = Auth::check();

        if($check){
            if(Auth::user()->hasRole('superadmin')){
                return redirect()->route('dashboard.index');
            }else{
                return redirect()->route('cashier.index');
            }
        }else{
            return view('login.index');
        }
    }

    public function post(request $request){
        $messages = [
            'email.required' => Lang::get('web.login-email.required'),
            'password.required' => Lang::get('web.login-password.required'),
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ], $messages);

        if($validator->fails())
        {
            $validator->errors()->add('login', Lang::get('web.login-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if(Auth::attempt($request->only('email', 'password'))){
            if(Auth::user()->hasRole('superadmin')){
                return redirect()->route('dashboard.index');
            }else{
                return redirect()->route('cashier.index');
            }
        }
        else
            return redirect()->back()->withInput()->withErrors(['login' => Lang::get('web.login-failed')]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login.index');
    }


}
