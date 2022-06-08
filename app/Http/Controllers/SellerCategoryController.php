<?php

namespace App\Http\Controllers;

use App\Models\SellerCategory;
use App\Http\Requests\StoreSellerCategoryRequest;
use App\Http\Requests\UpdateSellerCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('seller_categories')
            ->select('id', 'name')
            ->get();

        return response()->json([
            'categories' => $categories,
            'status' => 200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSellerCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = SellerCategory::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'category is created successfully',
            'category' => $category->name,
            'status' => 201
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SellerCategory  $sellerCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SellerCategory $sellerCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SellerCategory  $sellerCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SellerCategory $sellerCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSellerCategoryRequest  $request
     * @param  \App\Models\SellerCategory  $sellerCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SellerCategory $sellerCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SellerCategory  $sellerCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SellerCategory $sellerCategory)
    {
        //
    }
}
