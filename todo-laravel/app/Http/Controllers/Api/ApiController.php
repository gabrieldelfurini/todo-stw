<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function register (Request $request){

        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required",
            // "password" => "required|confirmed",
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        return response()->json([
            "status" => true,
            "message" => "User created successfully"
        ]);
    }

    public function login (Request $request){

        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if(Auth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ])){

            $user = Auth::user();

            $token = $user->createToken("myToken")->accessToken;

            return response()->json([
                "status" => true,
                "message" => "User Logged in successfully",
                "access_token" => $token
            ], 200);


        } else {

            return response()->json([
                "status" => false,
                "message" => "Invalid Login Details"
            ], 401);
        }
    }

    public function profile (){
        
        $user = Auth::user();

        return response()->json([
            "status" => true,
            "message" => "Profile Information",
            "data" => $user
        ]);
}

    public function logout (){

        auth()->user()->token()->revoke();

        return response()->json([
            "status" => true,
            "message" => "User Logged Out",
        ]);
    }

}
