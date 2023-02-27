<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;   //user Model
use Illuminate\Http\Response;  //response for custom responses
use Illuminate\Support\Facades\Hash;   //BCrypt to hash password
use PhpParser\Node\Stmt\TryCatch;


class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users, email",
            "password" => "required|string|confirmed"
        ]);


        // create a user
        $user = User::create([
        "name" => $fields["name"],
        "email" => $fields["email"],
        "password" => bcrypt($fields["password"])
        ]);

        // create token
        $token = $user->createToken("myapptoken")->plainTextToken;

        $response = [
            "user" => $user,
            "token" => $token
        ];

        return response($response, 201);
    }


    // logging in
    public function login(Request $request){
        $fields = $request->validate([
            "email" => "required|string",
            "password" => "required|string"
        ]);

        // check email
        $user = User::where("email", $fields["email"]) -> first();

        // check password
        if(!$user || !Hash::check($fields["password"], $user->password)){
            return response([
                "message" => "invalid credentials"
            ], 401);
        }
        
    }

    
}
