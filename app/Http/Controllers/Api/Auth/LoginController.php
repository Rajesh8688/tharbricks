<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseApiController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends BaseApiController
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }



        $user = User::where(['back_end_user' => '0' , 'is_vendor' => '1' ,'status' => 'Active','email'=> $request->email])->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $user = User::select('id','email','mobile','name',$this->ApiImage("/uploads/users/","profile_pic" ))->find($user->id);
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['user' => $user,'token' => $token,"status"=>true ,"message" => "success"];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch" , "status"=>false];
                return response($response, 200);
            }
        } else {
            $response = ["message" =>'User does not exist',"status"=>false];
            return response($response, 200);
        }

        // return response(['user' => auth()->user(), 'token' => $token]);

    }
}
