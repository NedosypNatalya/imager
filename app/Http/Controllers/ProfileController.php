<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

class ProfileController extends Controller
{
    public function profileUpdate(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);

        if($validator->fails()){
            return 'Validation Error: '.$validator->errors();       
        }
        $user = (new User)->find($input['id']);
        $user->name = $input['name'];
        $user->email = $input['email'];
        if(!empty($input['password'])){
            $user->password = bcrypt($input['password']);
        }
        $user->save();
        return view('profile', ['message' => 'Изменения сохранены', 'user' => Auth::user()]);
    }
}
