<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Validator;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'email' => 'required|unique:users,email|min:5|max:60',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'status' => 400
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('app')->accessToken;

        return response()->json([
            'message' => "Registration is done successfully",
            'token' => $token,
            'user' => $user,
            'status' => 200
        ]);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|max:30'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'status' => 400
            ]);
        }

        if (Auth::guard('user')->attempt($request->only('email', 'password'))) {

            $user = Auth::guard('user')->user();

            $token = $user->createToken('app')->accessToken;

            return response()->json([
                'message' => "Successfully Logged in",
                'token' => $token,
                'user' => $user,
                'status' => 200
            ]);
        }

        return response()->json([
            'message' => 'Invalid Email Or Password',
            'status' => 401
        ]);
    }


    public function viewLoggedInUser()
    {
        return response()->json([
            'user' => Auth::guard('user-api')->user(),
            'status' => 200
        ]);
    }
}
