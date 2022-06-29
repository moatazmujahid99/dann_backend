<?php

namespace App\Http\Controllers;

use App\Models\Seller;

use Illuminate\Http\Request;
use Hash;
use Auth;

class WebSellerController extends Controller
{
    function create(Request $request)
    {
        //Validate inputs
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:sellers,email',
            'password' => 'required|min:5|max:30|confirmed',

        ]);

        $seller = new Seller();
        $seller->name = $request->name;
        $seller->email = $request->email;
        $seller->password = Hash::make($request->password);
        $save = $seller->save();

        if ($save) {
            return redirect()->route('seller.login');
        } else {
            return redirect()->back();
        }
    }

    function check(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'email' => 'required|email|exists:sellers,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'This email is not exists'
        ]);

        $creds = $request->only('email', 'password');

        if (Auth::guard('seller')->attempt($creds)) {
            return redirect()->route('seller.dashboard');
        } else {
            return redirect()->back();
        }
    }

    function logout()
    {
        Auth::guard('seller')->logout();
        return redirect('/');
    }
}
