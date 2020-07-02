<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Services\Dadata;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request){
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
       /* $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return $this->sendResponse($success, 'User register successfully.');*/
        return "User register successfully.";
    }

   /* public function setAddress(Request $request){
            $data = [
                'query' => $request->message,
                'count' => 10
            ];
            $result = (new Dadata)->suggestAddress($data);
            $response = array(
                'status' => 'success',
                'data' => $result,
            );
        return response()->json($response); 
    }

    public function setEmail(Request $request) {
        $data = [
            'query' => $request->message,
            'count' => 5
        ];
        $result = (new Dadata)->suggestEmail($data);
            $response = array(
                'status' => 'success',
                'data' => $result,
            );
        return response()->json($response); 
    }*/

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
