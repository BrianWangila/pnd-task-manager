<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\User;   //user Model
use App\Rules\MatchOldPassword;
use Illuminate\Http\Response;  //response for custom responses
use Illuminate\Support\Facades\Hash;   //BCrypt to hash password
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request){
        try {
            $credentials = $request->validate([
                "name" => "required|string",
                "email" => "required|string|email",
                // "password" => "string|confirmed",
                // "remember" => "boolean"
            ]);
    
            // create a user
            $user = User::create([
            "name" => $credentials["name"],
            "email" => $credentials["email"],
            "password" => bcrypt("password")
            ]);
    
            // create token
            $token = $user->createToken("myapptoken")->plainTextToken;
    
            $response = ([
                "user" => $user,
                "token" => $token,
                "message" => "User created"
            ]);

            try {
                $employee1 = Employee::create([
                    "department_id" => $request -> departmentId, 
                    "user_id" => $user -> id,
                    "job_title" => $request -> jobTitle, 
                    "role" => $request -> role, 
                ]);
    
                return response([
                    $employee1,
                    "message" => "Employee profile created"
                ]);
                
            } catch (\exception $e) {
                $response = [
    
                    "error" => $e->getMessage(),
                    "message" => "Check your input fields, something went wrong",
    
                ];
    
                return response()->json($response, 500);
            }
        
    
            return response($response, 201);

            
        } catch (\Throwable $th) {
            return $response = ([

                "message" => "Something went wrong",
                "error" => $th->getMessage(),
            ]);
    
            return response($response, 500);
        }
    }


    // logging in
    public function login(Request $request){
        
        try {
            $credentials = $request->validate([
                "email" => "required|string|email|exists:users,email",
                "password" => "required|string",
                 "remember" => "boolean"
            ]);
    
            // After validating, check if they match
            $remember = $credentials['remember'] ?? false;
            unset($credentials['remember']);
    
            if(!Auth::attempt($credentials, $remember)){
                return response([
                    "error" => "Password is incorrect"
                ], status: 401);
            }

    
            // check email
            $user = User::where("email", $credentials["email"]) -> first();
    
            // check password
            if(!$user || !Hash::check($credentials["password"], $user->password)){
                return response([
                    "message" => "invalid credentials"
                ], 401);
            }


            // get user
            $user = Auth::user();
    
            // create token
            $token = $user->createToken("myapptoken")->plainTextToken;
    
            $response = [
                "status" => 201,
                "user" => Employee::with('user')->where('user_id', $user->id)->first(),
                // "user" => $user,
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

        // $user = Auth::user();
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


    //delete user
    public function delete($id) {
        
        
        try {
            $user = User::find($id);
            $user->delete();

            return response([
                "message" => "User deleted"
            ], 204);

        } catch (\Throwable $th) {
            $response = [
                "status" => 500,
                "message" => "Something went wrong",
                "error" => $th->getMessage()
            ];

            return response()->json($response, 500);
        }

    }


    //update user
    public function update(Request $request, $id) {

        $user = User::find($id);

        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password ? Hash::make($request->password) : $user->password
        ]);
    }
    


    //change password
    public function changePassword (Request $request, $id){

        $request->validate([
            'currentPassword' => ['required', new MatchOldPassword],
            'newPassword' => ['required', 'min:8', 'confirmed'],
        ]);
    
        // $user = User::find($id);
        $user = Auth::user();
        $user->password = Hash::make($request->newPassword);
        $user->save();
    
        return response()->json(['message' => 'Password changed successfully!']);
    }
    
}
