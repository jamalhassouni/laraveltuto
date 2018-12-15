<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Validator;

class Users extends Controller
{
    public function login()
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return response(['status' => false, 'messages' => $validate->messages()]);
        }else{
            if (auth()->attempt(['email'=>request('email'),'password'=>request('password')])){
                $user = auth()->user();
                $user->api_token = str_random(60);
                $user->save();
                return response(['status'=>true,'user'=>$user,'token'=>$user->api_token]);
            }else{
                return response(['status' => false, 'messages' => 'The Email Or Password Incorrect']);

            }
        }
    }

}
