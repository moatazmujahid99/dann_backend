<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\Seller;
use App\Models\Category;
use App\Models\ProductList;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class ProductListController extends Controller
{

    public function GetAllProductList()
    {
        $productlist = ProductList::orderBy('updated_at', 'DESC')->get();
        foreach ($productlist as $product) {
            if (isset($product->seller_id)) {
                $product->seller_name = $product->seller->name;
                $product->seller_image = $product->seller->seller_img ? URL::to('images/sellers/' . $product->seller->seller_img) : null;
                unset($product->seller);
            }
        }
        return $productlist;
    }

    public function ProductListByRemark(Request $request)
    {

        $remark = $request->remark;
        $productlist = ProductList::where('remark', $remark)->limit(8)->get();
        foreach ($productlist as $product) {
            if (isset($product->seller_id)) {
                $product->seller_name = $product->seller->name;
                $product->seller_image = $product->seller->seller_img ? URL::to('images/sellers/' . $product->seller->seller_img) : null;
                unset($product->seller);
            }
        }
        return $productlist;
    } // End Method

    public function ProductListByCategory(Request $request)
    {

        $Category = $request->category;
        $productlist = ProductList::where('category', $Category)->get();
        foreach ($productlist as $product) {
            if (isset($product->seller_id)) {
                $product->seller_name = $product->seller->name;
                $product->seller_image = $product->seller->seller_img ? URL::to('images/sellers/' . $product->seller->seller_img) : null;
                unset($product->seller);
            }
        }
        return $productlist;
    } // End Method


    public function ProductListBySubCategory(Request $request)
    {

        $Category = $request->category;
        $SubCategory = $request->subcategory;
        $productlist = ProductList::where('category', $Category)->where('subcategory', $SubCategory)->get();
        foreach ($productlist as $product) {
            if (isset($product->seller_id)) {
                $product->seller_name = $product->seller->name;
                $product->seller_image = $product->seller->seller_img ? URL::to('images/sellers/' . $product->seller->seller_img) : null;
                unset($product->seller);
            }
        }
        return $productlist;
    } // End Method



    public function ProductBySearch(Request $request)
    {

        $key = $request->key;
        $productlist = ProductList::where('title', 'LIKE', "%{$key}%")->orWhere('brand', 'LIKE', "%{$key}%")->get();
        return $productlist;
    } // End Method


    public function SimilarProduct(Request $request)
    {
        $subcategory = $request->subcategory;
        $productlist = ProductList::where('subcategory', $subcategory)->orderBy('id', 'desc')->limit(6)->get();
        return $productlist;
    } // End Method



    public function GetAllProduct()
    {

        $products = ProductList::latest()->paginate(10);
        return view('backend.product.product_all', compact('products'));
    } // End Method


    public function AddProduct()
    {

        $category = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = Subcategory::orderBy('subcategory_name', 'ASC')->get();

        $sellers = DB::table('sellers')
            ->select('id', 'name')
            ->get();

        return view('backend.product.product_add', compact('category', 'subcategory', 'sellers'));
    } // End Method


    public function StoreProduct(Request $request)
    {

        $request->validate([
            'product_code' => 'required',
            'image_one' => 'required',
            'short_description' => 'required',
            'color' => 'required',
            'title' => 'required',
            'price' => 'required',
            'image' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'seller_id' => 'integer'

        ], [
            'product_code.required' => 'Input Product Code',
            'seller_id.integer' => 'Please choose shop'
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();


        // omar - check
        // Image::make($image)->resize(711,960)->save('upload/product/'.$name_gen);

        // resize the image to a height of 700 and constrain aspect ratio (auto width)
        // prevent possible upsizing
        Image::make($image)->resize(null, 245, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })


            ->save('upload/product/' . $name_gen);



        $save_url = URL::to('upload/product/' . $name_gen);
        //omar-check
        //product rating
        $star = 'N/A';
        $product_id = ProductList::insertGetId([
            'title' => $request->title,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'product_code' => $request->product_code,
            'image' => $save_url,
            'star' => $star,
            'seller_id' => $request->seller_id,
        ]);

        /////// Insert Into Product Details Table //////

        $image1 = $request->file('image_one');
        $name_gen1 = hexdec(uniqid()) . '.' . $image1->getClientOriginalExtension();
        Image::make($image1)->resize(null, 392, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })
            ->save('upload/productdetails/' . $name_gen1);
        $save_url1 = URL::to('upload/productdetails/' . $name_gen1);


        $product = ProductDetails::create([
            'product_id' => $product_id,
            'image_one' => $save_url1,
            'short_description' => $request->short_description,
            'color' =>  $request->color,
            'size' =>  $request->size,
            'long_description' => $request->long_description,
            'seller_id' => $request->seller_id,
        ]);

        if (isset($request->image_two)) {
            $image2 = $request->file('image_two');
            $name_gen2 = hexdec(uniqid()) . '.' . $image2->getClientOriginalExtension();
            Image::make($image2)->resize(null, 392, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
                ->save('upload/productdetails/' . $name_gen2);
            $save_url2 = URL::to('upload/productdetails/' . $name_gen2);

            $product->update([
                'image_two' => $save_url2,
            ]);
        }


        if (isset($request->image_three)) {
            $image3 = $request->file('image_three');
            //omar - check
            $name_gen3 = hexdec(uniqid()) . '.' . $image3->getClientOriginalExtension();
            Image::make($image1)->resize(null, 392, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
                ->save('upload/productdetails/' . $name_gen3);
            $save_url3 = URL::to('upload/productdetails/' . $name_gen3);


            $product->update([
                'image_three' => $save_url3,
            ]);
        }


        if (isset($request->image_four)) {
            $image4 = $request->file('image_four');
            $name_gen4 = hexdec(uniqid()) . '.' . $image4->getClientOriginalExtension();
            Image::make($image4)->resize(null, 392, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
                ->save('upload/productdetails/' . $name_gen4);
            $save_url4 = URL::to('upload/productdetails/' . $name_gen4);

            $product->update([
                'image_four' => $save_url4,
            ]);
        }

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    } // End Store product Method



    public function EditProduct($id)
    {

        $category = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = Subcategory::orderBy('subcategory_name', 'ASC')->get();
        $product = ProductList::findOrFail($id);
        $details = ProductDetails::where('product_id', $id)->get();
        $sellers = Seller::all();
        return view('backend.product.product_edit', compact('category', 'subcategory', 'product', 'details', 'sellers'));
    } // End Method


    public function UpdateProduct(Request $request, $id)
    {
        $productDetails = ProductDetails::where('product_id', $id)->first();
        $prodcutList = ProductList::findOrFail($id);

        $request->validate([
            'product_code' => 'required',
            'image_one' => 'required',
            'short_description' => 'required',
            'color' => 'required',
            'title' => 'required',
            'price' => 'required',
            'image' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'seller_id' => 'integer'

        ], [
            'product_code.required' => 'Input Product Code',
            'seller_id.integer' => 'Please choose shop'
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();


        // omar - check
        // Image::make($image)->resize(711,960)->save('upload/product/'.$name_gen);

        // resize the image to a height of 700 and constrain aspect ratio (auto width)
        // prevent possible upsizing
        Image::make($image)->resize(null, 245, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })


            ->save('upload/product/' . $name_gen);



        $save_url = URL::to('upload/product/' . $name_gen);
        //omar-check
        //product rating
        $star = 'N/A';
        $prodcutList->update([
            'title' => $request->title,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'product_code' => $request->product_code,
            'image' => $save_url,
            'star' => $star,
            'seller_id' => $request->seller_id,
        ]);

        /////// Insert Into Product Details Table //////

        $image1 = $request->file('image_one');
        $name_gen1 = hexdec(uniqid()) . '.' . $image1->getClientOriginalExtension();
        Image::make($image1)->resize(null, 392, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })
            ->save('upload/productdetails/' . $name_gen1);
        $save_url1 = URL::to('upload/productdetails/' . $name_gen1);


        $productDetails->update([
            'product_id' => $id,
            'image_one' => $save_url1,
            'short_description' => $request->short_description,
            'color' =>  $request->color,
            'size' =>  $request->size,
            'long_description' => $request->long_description,
            'seller_id' => $request->seller_id,
        ]);

        if (isset($request->image_two)) {
            $image2 = $request->file('image_two');
            $name_gen2 = hexdec(uniqid()) . '.' . $image2->getClientOriginalExtension();
            Image::make($image2)->resize(null, 392, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
                ->save('upload/productdetails/' . $name_gen2);
            $save_url2 = URL::to('upload/productdetails/' . $name_gen2);

            $productDetails->update([
                'image_two' => $save_url2,
            ]);
        }


        if (isset($request->image_three)) {
            $image3 = $request->file('image_three');
            //omar - check
            $name_gen3 = hexdec(uniqid()) . '.' . $image3->getClientOriginalExtension();
            Image::make($image1)->resize(null, 392, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
                ->save('upload/productdetails/' . $name_gen3);
            $save_url3 = URL::to('upload/productdetails/' . $name_gen3);


            $productDetails->update([
                'image_three' => $save_url3,
            ]);
        }


        if (isset($request->image_four)) {
            $image4 = $request->file('image_four');
            $name_gen4 = hexdec(uniqid()) . '.' . $image4->getClientOriginalExtension();
            Image::make($image4)->resize(null, 392, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
                ->save('upload/productdetails/' . $name_gen4);
            $save_url4 = URL::to('upload/productdetails/' . $name_gen4);

            $productDetails->update([
                'image_four' => $save_url4,
            ]);
        }

        $notification = array(
            'message' => 'Product updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }



    public function DeleteProduct($id)
    {
        ProductList::findOrFail($id)->delete();

        $details = ProductDetails::where('product_id', $id)->first();
        $details->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
