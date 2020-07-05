<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Services\Dadata;

class RegisterController extends Controller
{

    public function getRegisterForm(){
        return view('formRegister');
    }

    public function register(RegisterRequest $request){
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return "User register successfully.";
    }

    public function setData(Request $request){
        $data = [
            'query' => $request->message,
            'count' => $request->count
        ];
        $result = (new Dadata)->suggestPostData($data, $request->category);
            $response = array(
                'status' => 'success',
                'data' => $result,
            );
        return response()->json($response);
    }
}
