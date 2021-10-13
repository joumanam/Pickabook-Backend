<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors(), "code" => 422]);
        }

        if (!$token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['message' => 'Unauthorized', "code" => 401]);
        }

        return $this->loginUser($token, false);
    }

    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors(), "code" => 422]);
        }

        if (!$token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['message' => 'Unauthorized', "code" => 401]);
        }

        return $this->loginUser($token, true);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
        ], 201);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(["message" => "Logged out successfully"]);
    }

    private function loginUser($token, $is_admin)
    {
        if ($is_admin) {
            if (auth()->user()->role !== "Admin") {
                return response()->json(['message' => 'Unauthorized', "code" => 401]);
            }
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 24 * 60,
            'user' => auth()->user(),
            'code' => 200,
        ]);

    }
}
