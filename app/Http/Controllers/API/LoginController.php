<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->sendError('You cannot sign with those credentials.');     
        }

        $token = Auth::user()->createToken(config('app.name'));
        $success['token_type'] = 'Bearer';
        $success['token'] = $token->accessToken;
       // $user = Auth::user();
       // return redirect()->route('profile', ['user' => Auth::user()]);//, [/*'user' => Auth::user()*/$user]);
        //return redirect()->action('FormController@profile', ['user' => Auth::user()]);
        //view('profile', ['user' => Auth::user()]);//
        return $this->sendResponse($success, 'User authorizate successfully.');
    }
}
