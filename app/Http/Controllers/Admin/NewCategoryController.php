<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Image;

class NewCategoryController extends Controller
{
    public function AllCategory(){

        $categories = Category::all();
        $categoryDetailsArray = [];

        foreach ($categories as $value) {
            $subcategory = Subcategory::where('category_name',$value['category_name'])->get();

            $item = [
                'category_name' => $value['category_name'],
                'category_image' => $value['category_image'],
                'subcategory_name' => $subcategory
            ];

            array_push($categoryDetailsArray, $item);

        }
        return $categoryDetailsArray;

    } // End



    public function GetAllCategory(){

        $category = Category::latest()->get();
        return view('backend.category.category_view',compact('category'));

    } // End


    public function AddCategory(){
      return view('backend.category.category_add');
    } // End


    public function StoreCategory(Request $request){

        $request->validate([
            'category_name' => 'required',
        ],[
            'category_name.required' => 'Input Category Name'

        ]);

        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(null, 128, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();})->save('upload/category/'.$name_gen);
        $save_url = 'http://127.0.0.1:8000/upload/category/'.$name_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'category_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);

    }// End


    public function EditCategory($id){

        $category = Category::findOrFail($id);
        return view('backend.category.category_edit',compact('category'));

    } //End


    public function UpdateCategory(Request $request){

        $category_id = $request->id;

        if ($request->file('category_image')) {

        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // omar - check
        Image::make($image)->resize(null, 128, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();})->save('upload/category/'.$name_gen);
        $save_url = 'http://127.0.0.1:8000/upload/category/'.$name_gen;

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'category_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Category Update With Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);

        }
        else{

             Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,

        ]);

        $notification = array(
            'message' => 'Category Updateed Without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);

        }

    } //End



    public function DeleteCategory($id){

    Category::findOrFail($id)->delete();

    $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } //End



///////////// Start Sub Category All Methods. ////////////////


    public function GetAllSubCategory(){
   $subcategory = Subcategory::latest()->get();
        return view('backend.subcategory.subcategory_view',compact('subcategory'));

    } //End


    public function AddSubCategory(){

        $category = Category::latest()->get();
         return view('backend.subcategory.subcategory_add',compact('category'));
    } //End


    public function StoreSubCategory(Request $request){


        $request->validate([
            'subcategory_name' => 'required',
        ],[
            'subcategory_name.required' => 'Input SubCategory Name'

        ]);



        Subcategory::insert([
            'category_name' => $request->category_name,
            'subcategory_name' => $request->subcategory_name,
        ]);

        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);

    } //End


    public function EditSubCategory($id){

        $category = Category::orderBy('category_name','ASC')->get();
        $subcategory = Subcategory::findOrFail($id);
        return view('backend.subcategory.subcategory_edit',compact('category','subcategory'));

    } //End

    public function UpdateSubCategory(Request $request){

        $subcategory_id = $request->id;

        Subcategory::findOrFail($subcategory_id)->update([
            'category_name' => $request->category_name,
            'subcategory_name' => $request->subcategory_name,
        ]);

        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);

    } //End


    public function DeleteSubCategory($id){

        Subcategory::findOrFail($id)->delete();
         $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } //End



}
