<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Seller\SellerController;
use App\Http\Controllers\Api\Customer\CustomerController;

use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//(seller or customer) only can access those routes
Route::get('/sellers', [SellerController::class, 'index']);
Route::get('/seller/{seller_id}', [SellerController::class, 'show']);

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customer/{customer_id}', [CustomerController::class, 'show']);


//anyone acccess those routes
Route::post('/create/category/for_sellers', [CategoryController::class, 'store']);
Route::get('/sellers/categories', [CategoryController::class, 'index']);
