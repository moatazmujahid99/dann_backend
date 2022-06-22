<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function AllSlider()
    {
        $result = HomeSlider::all();
        return $result;
    } // End


    public function GetAllSlider()
    {
        $slider = HomeSlider::latest()->get();
        return view('backend.slider.slider_view', compact('slider'));
    } // End


    public function AddSlider()
    {

        return view('backend.slider.slider_add');
    } // End

    public function StoreSlider(Request $request)
    {

        $request->validate([
            'slider_image' => 'required',
        ], [
            'slider_image.required' => 'Upload Slider Image'

        ]);

        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(null, 380, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save('upload/slider/' . $name_gen);
        $save_url = URL::to('upload/slider/' . $name_gen);

        HomeSlider::insert([
            'slider_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    } // End


    public function EditSlider($id)
    {
        $slider = HomeSlider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('slider'));
    } // End


    public function UpdateSlider(Request $request)
    {

        $slider_id = $request->id;

        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(null, 380, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save('upload/slider/' . $name_gen);
        $save_url = URL::to('upload/slider/' . $name_gen);

        HomeSlider::findOrFail($slider_id)->update([
            'slider_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Slider Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    } // End


    public function DeleteSlider($id)
    {

        HomeSlider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End

}
