<?php

namespace App\Http\Controllers\Api\customer;

use Auth;
use Hash;
use Validator;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Laravel\Passport\ClientRepository;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'email' => 'required|email|unique:customers,email|min:5|max:60',
            'password' => 'required|min:6|max:30|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'status' => 400
            ],400);
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        App::clearResolvedInstance(ClientRepository::class);
        app()->singleton(ClientRepository::class, function () {
            return new ClientRepository(env('CUSTOMER_ID'), null); // You should give the client id in the first parameter
        });

        $token = $customer->createToken('app')->accessToken;

        return response()->json([
            'message' => "Registration is done successfully",
            'token' => $token,
            'customer' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'password' => $customer->password
            ],
            'status' => 201
        ],201);
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
            ],400);
        }

        if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
            App::clearResolvedInstance(ClientRepository::class);
            app()->singleton(ClientRepository::class, function () {
                return new ClientRepository(env('CUSTOMER_ID'), null); // You should give the client id in the first parameter
            });

            $customer = Auth::guard('customer')->user();

            $token = $customer->createToken('app')->accessToken;

            return response()->json([
                'message' => "Successfully Logged in",
                'token' => $token,
                'customer' => [
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'password' => $customer->password
                ],
                'status' => 200
            ],200);
        }

        return response()->json([
            'message' => 'Invalid Email Or Password',
            'status' => 401
        ],401);
    }


    // public function viewLoggedInCustomer()
    // {
    //     return response()->json([
    //         'customer' => Auth::guard('customer-api')->user(),
    //         'status' => 200
    //     ]);
    // }
}
