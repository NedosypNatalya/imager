<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Validator;

class ProfileController extends BaseController
{
    public function update(Request $request, $id){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:3',
            'c_password' => 'required|same:password'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user = (new User)->find($input['id']);
        $user->name = $input['name'];
        $user->email = $input['email'];
        if(!empty($input['password'])){
            $user->password = bcrypt($input['password']);
        }
        $user->save();
        return $this->sendResponse($post->toArray(), 'Post updated successfully.');
    }
}
