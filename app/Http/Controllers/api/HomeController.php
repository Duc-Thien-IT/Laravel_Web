<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    // POST [ name, email, password ]
    /**
    * @OA\Post(
    *   path="/api/register",
    *   operationId="Register",
    *   tags={"Register"},
    *   summary="User Register",
    *   description="User Register here",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"name","email", "password", "password_confirmation"},
    *               @OA\Property(property="name", type="text"),
    *               @OA\Property(property="email", type="text"),
    *               @OA\Property(property="password", type="password"),
    *               @OA\Property(property="password_confirmation", type="password")
    *            ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="Register Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Register Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=422,
    *          description="Unprocessable Entity",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function register(Request $request){

        // Validation
        $request->validate([
            "name" => "required|string",
            "email" => "required|string|email|unique:users",
            "password" => "required|confirmed" // password_confirmation
        ]);

        // Create User
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        return response()->json([
            "status" => true,
            "message" => "User registered successfully",
            "data" => []
        ]);
    }

    // POST [ email, password ]
    /**
    * @OA\Post(
    *     path="/api/login",
    *     operationId="Login",
    *     tags={"Login"},
    *     summary="User Login",
    *     description="User Login here",
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"email", "password"},
    *               @OA\Property(property="email", type="string", example="sanjay@gmail.com"),
    *               @OA\Property(property="password", type="string", example="123456"),
    *            ),
    *        ),
    *        @OA\MediaType(
    *            mediaType="application/json",
    *            @OA\Schema(
    *               type="object",
    *               required={"email", "password"},
    *               @OA\Property(property="email", type="string", example="sanjay@gmail.com"),
    *               @OA\Property(property="password", type="string", example="123456"),
    *            ),
    *        ),
    *    ),
    *    @OA\Response(
    *        response=201,
    *        description="Login Successfully",
    *        @OA\JsonContent()
    *    ),
    *    @OA\Response(
    *        response=200,
    *        description="Login Successfully",
    *        @OA\JsonContent()
    *    ),
    *    @OA\Response(
    *        response=422,
    *        description="Unprocessable Entity",
    *        @OA\JsonContent()
    *    ),
    *    @OA\Response(response=400, description="Bad request"),
    *    @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function login(Request $request){

        $request->validate([
            "email" => "required|email|string",
            "password" => "required"
        ]);

        // User object
        $user = User::where("email", $request->email)->first();

        if(!empty($user)){

            // User exists
            if(Hash::check($request->password, $user->password)){

                // Password matched
                $token = $user->createToken("mytoken")->accessToken;

                return response()->json([
                    "status" => true,
                    "message" => "Login successful",
                    "token" => $token,
                    "data" => []
                ]);
            }else{

                return response()->json([
                    "status" => false,
                    "message" => "Password didn't match",
                    "data" => []
                ]);
            }
        }else{

            return response()->json([
                "status" => false,
                "message" => "Invalid Email value",
                "data" => []
            ]);
        }
    }

}
