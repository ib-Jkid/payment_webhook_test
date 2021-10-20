<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_page() {
        return view('login');
    }

    public function register_page() {
        return view('register');
    }


    public function logout() {
        if(Auth::check()) {
            Auth::logout();
        }

        return redirect()->route("login");
    }


    public function login(Request $request) {
        
        $this->validate($request,[
            "email"=> "required",
            "password" => "required",
            "remember" => "in:0,1"
        ]);


        if(!Auth::attempt($request->only("email","password"),$request->remember)) {
            $request->session()->flash("danger","Authentication Failed");

            return redirect()->back();


        }

        $request->session()->flash("success","Authentication Successful");

        return redirect()->route("dashboard");
        
    }


    public function register(Request $request) {
    
        $this->validate($request,[
            "name" => "required",
            "email"=> "required",
            "password" => "required|confirmed"
        ]);


        $request->merge(['password' =>  Hash::make($request->password) ]);

        $user = User::create($request->only("name","email","password"));


        $request->session()->flash("success","User Registered successfully");
        return redirect()->route("login");
    }

}
