<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use Hash;
use Validator;
use Auth;
use App\Http\Resources\seller\SellerResource;
use Laravel\Passport\ClientRepository;
use Illuminate\Support\Facades\App;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'email' => 'required|email|unique:sellers,email|min:5|max:60',
            'password' => 'required|min:6|max:30|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'status' => 400
            ], 400);
        }

        $seller = Seller::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        App::clearResolvedInstance(ClientRepository::class);
        app()->singleton(ClientRepository::class, function () {
            return new ClientRepository(env('SELLER_ID'), null); // You should give the client id in the first parameter
        });

        $token = $seller->createToken('app')->accessToken;

        return response()->json([
            'message' => "Registration is done successfully",
            'token' => $token,
            'seller' => [
                'id' => $seller->id,
                'name' => $seller->name,
                'email' => $seller->email,
                'password' => $seller->password
            ],
            'status' => 201
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:5|max:60',
            'password' => 'required|min:6|max:30'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'status' => 400
            ], 400);
        }

        if (Auth::guard('seller')->attempt($request->only('email', 'password'))) {
            App::clearResolvedInstance(ClientRepository::class);
            app()->singleton(ClientRepository::class, function () {
                return new ClientRepository(env('SELLER_ID'), null); // You should give the client id in the first parameter
            });

            $seller = Auth::guard('seller')->user();


            $token = $seller->createToken('app')->accessToken;

            return response()->json([
                'message' => "Successfully Logged in",
                'token' => $token,
                'seller' => [
                    'id' => $seller->id,
                    'name' => $seller->name,
                    'email' => $seller->email,
                    'password' => $seller->password
                ],
                'status' => 200
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid Email Or Password',
            'status' => 401
        ], 401);
    }


    // public function viewLoggedInSeller()
    // {
    //     return response()->json([
    //         'seller' => new SellerResource(Auth::guard('seller-api')->user()),
    //         'status' => 200
    //     ]);
    // }
}
