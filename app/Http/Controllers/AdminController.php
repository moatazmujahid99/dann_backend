<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminLogout()
    {

        Auth::logout();
        return Redirect()->route('login');
    } // end


    public function UserProfile()
    {

        if (Auth::guard('seller')->check()) {
            $adminData = Auth::guard('seller')->user();
        }


        if (Auth::guard('web')->check()) {
            $adminData = Auth::user();
        }


        return view('backend.admin.admin_profile', compact('adminData'));
    } // end


    public function UserProfileStore(Request $request)
    {

        $data = Auth::user();
        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/' . $data->profile_photo_path));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.profile')->with($notification);
    } // end



    public function ChangePassword()
    {
        return view('backend.admin.change_password');
    } // end


    public function ChangePasswordUpdate(Request $request)
    {

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = User::find(1)->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(1);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('admin.logout');
        } else {
            return redirect()->back();
        }
    } // end

}
