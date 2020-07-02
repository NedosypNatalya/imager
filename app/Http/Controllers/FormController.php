<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function register(){
        return view('formRegister');
    }
    public function login(){
        return view('formLogin');
    }
    public function profile(){
        return view('profile', ['user' => Auth::user()]);
    }
}
