<?php


namespace App\services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function isValidCredential($request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password'=>['required']
        ]);
        if(!Auth::attempt($request->only(['email','password']))){
            $message='Email & password does not match with our record.';
            return [
                'success'=>false,
                'message'=>$message
            ];
        }
        $user=User::query()->where('email',$request['email'] )->first();
        return [
            'success'=>true,
            'user'=>$user,
        ];
    }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();
    }
}

