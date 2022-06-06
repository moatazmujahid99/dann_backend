<?php

namespace App\Http\Controllers\Api\Seller;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\seller\SellersDisplay;
use App\Http\Resources\seller\SellerResource;


class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::guard('seller-api')->check()) {
            $sellers = Seller::where('id', '!=', Auth::guard('seller-api')->user()->id)->get();
        } elseif (Auth::guard('customer-api')->check()) {
            $sellers = Seller::all();
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ]);
        }


        return response()->json([
            'sellers' => SellersDisplay::collection($sellers),
            'status' => 200
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seller = Seller::find($id);

        if (!$seller) {
            return response()->json([
                'message' => "seller not found",
                'status' => 404
            ]);
        }

        if (Auth::guard('seller-api')->check() || Auth::guard('customer-api')->check()) {

            return response()->json([
                'seller' => new SellerResource($seller),
                'status' => 200
            ]);
        } else {

            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seller = Seller::find($id);

        if (!$seller) {
            return response()->json([
                'message' => "seller not found",
                'status' => 404
            ]);
        }

        $validator = Validator::make($request->all(), [
            'address' => 'nullable|min:4|max:250',
            'phone_number' => 'nullable|digits:11',
            'seller_img' => 'image|max:5050|nullable|mimes:jpg,jpeg,png',
            'category_id' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'status' => 400
            ]);
        }

        if (isset($request->seller_img)) {
            $imageName = time() . '-' . $seller->name . '.' . $request->seller_img->extension();
            $request->seller_img->move(public_path('images/sellers'), $imageName);
            if (isset($seller->seller_img)) {
                $imagePath = public_path('images/sellers/' . $seller->seller_img);
                File::delete($imagePath);
            }
        } elseif (isset($seller->seller_img) && !(isset($request->seller_img))) {
            $imageName = $seller->seller_img;
        } else {
            $imageName = null;
        }
        $seller->update([
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'category_id' => $request->category_id,
            'seller_img' => $imageName,

        ]);

        return response()->json([
            'message' => "seller is updated successfully",
            'seller' => [
                'id' => $seller->id,
                'name' => $seller->name,
                'email' => $seller->email,
                'phone_number' => $seller->phone_number ?? null,
                'address' => $seller->address ?? null,
                'category' => $seller->category->category_name ?? null,
                'image_url' => $seller->seller_img ? URL::to('images/sellers/' . $seller->seller_img) : null
            ],
            'status' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        //
    }
}
