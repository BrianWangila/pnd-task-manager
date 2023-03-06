<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;   //user Model
use Illuminate\Http\Response;  //response for custom responses
use Illuminate\Support\Facades\Hash;   //BCrypt to hash password
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users, email",
            "password" => "required|string|confirmed",
            "remember" => "boolean"
        ]);


        // create a user
        $user = User::create([
        "name" => $fields["name"],
        "email" => $fields["email"],
        "password" => bcrypt($fields["password"])
        ]);

        // create token
        $token = $user->createToken("myapptoken")->plainTextToken;

        return $response = ([
            "user" => $user,
            "token" => $token
        ]);

        return response($response, 201);
    }


    // logging in
    public function login(Request $request){
        
        try {
            $fields = $request->validate([
                "email" => "required|string|email|exists:users,email",
                "password" => "required|string",
                 "remember" => "boolean"
            ]);
    
            // After validating, check if they match
            $remember = $fields['remember'] ?? false;
            unset($fields['remember']);
    
            if(!Auth::attempt($fields, $remember)){
                return response([
                    "error" => "Password is incorrect"
                ], status: 401);
            }
    
            // // check email
            // $user = User::where("email", $fields["email"]) -> first();
    
            // // check password
            // if(!$user || !Hash::check($fields["password"], $user->password)){
            //     return response([
            //         "message" => "invalid credentials"
            //     ], 401);
            // }

            // get user
            $user = Auth::user();
    
            // create token
            $token = $user->createToken("myapptoken")->plainTextToken;
    
            $response = [
                "status" => 201,
                "user" => $user,
                "token" => $token
            ];
    
            return response()->json($response, 201);

        } catch (\exception $e) {

            $response = [
                "status" => 500,
                "message" => "Something went wrong",
                "error" => $e->getMessage()
            ];

            return response()->json($response, 500);
        }
        
    }

    // logging out
    public function logout(Request $request){

        $user = Auth::user();
        try{

            Auth()->user()->tokens()->delete();

            $response = [

                "message" => "Logged out successfully",
            ];
            
            return response()->json($response, 200);
            
        }

        catch(\Exception $e){

            $response = [

                "message" => $e->getMessage(),
            ];

            return response()->json($response, 500);
        }
    }

    
}
