<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductList;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class ProductDetailsController extends Controller
{
    public function ProductDetails(Request $request)
    {

        $id = $request->id;

        $productDetails = ProductDetails::where('product_id', $id)->get();
        $productlist = ProductList::where('id', $id)->get();
        foreach ($productlist as $product) {
            if (isset($product->seller_id)) {
                $product->seller_name = $product->seller->name;
                $product->seller_image = $product->seller->seller_img ? URL::to('images/sellers/' . $product->seller->seller_img) : null;
                unset($product->seller);
            }
        }

        $item = [
            'productDetails' => $productDetails,
            'productList' => $productlist,
        ];

        return $item;
    } // End Method



}
