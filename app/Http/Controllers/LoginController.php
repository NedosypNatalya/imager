<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getLoginForm(){
        return view('formLogin');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) { 
           return   'You cannot sign with those credentials.'; 
        }
        $user = Auth::user();
       return redirect()->route('profile_form');
    }
}
