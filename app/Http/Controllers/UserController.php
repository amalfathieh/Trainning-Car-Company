<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function register(RegisterRequest $request)
    {
        $user=User::query()->create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>Hash::make($request->password),
            'role'=>'user',
        ]);
        $token=$user->createToken("API TOKEN")->plainTextToken;

        return response()->json([
            'user'=>$user,
            'token' => $token
        ],201);
    }
    //LOGIN METHOD -POST
    public function login(Request $request , AuthService $authService){
        $isValid = $authService->isValidCredential($request);
        if(!$isValid['success']){
            return response()->json([
                'data' =>null,
                'success' => false,
                'message' => $isValid['message'],
            ],  Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = $isValid['user'];
        $token = $user->createToken("API TOKEN")->plainTextToken;
        return response()->json([
            'user' =>$user,
            'token'=> $token,
            'success' => true,
            'message' => "Logout successfully",
        ], 200);

    }

    //LOGOUT METHOD -GET
    public function logout(AuthService $authService)
    {
        $authService->logout();
        return response()->json([
            'data' =>null,
            'success' => true,
            'message' => "Logout successfully",
        ], 200);
    }
}
