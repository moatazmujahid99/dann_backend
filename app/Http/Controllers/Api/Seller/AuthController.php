<?php

namespace App\Http\Controllers\Api\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use Hash;
use Validator;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'email' => 'required|email|unique:sellers,email|min:5|max:60',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'status' => 400
            ]);
        }

        $seller = Seller::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $seller->createToken('app')->accessToken;

        return response()->json([
            'message' => "Registration is done successfully",
            'token' => $token,
            'seller' => $seller,
            'status' => 200
        ]);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:sellers,email',
            'password' => 'required|min:5|max:30'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'status' => 400
            ]);
        }

        if (Auth::guard('seller')->attempt($request->only('email', 'password'))) {

            $seller = Auth::guard('seller')->user();

            $token = $seller->createToken('app')->accessToken;

            return response()->json([
                'message' => "Successfully Logged in",
                'token' => $token,
                'seller' => $seller,
                'status' => 200
            ]);
        }

        return response()->json([
            'message' => 'Invalid Email Or Password',
            'status' => 401
        ]);
    }


    public function viewLoggedInSeller()
    {
        return response()->json([
            'seller' => Auth::guard('seller-api')->user(),
            'status' => 200
        ]);
    }
}
