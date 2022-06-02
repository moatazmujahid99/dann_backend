<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Seller\SellerController;
use App\Http\Controllers\Api\Customer\CustomerController;

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



Route::get('/sellers', [SellerController::class, 'index']);
Route::get('/seller/{seller_id}', [SellerController::class, 'show']);

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customer/{customer_id}', [CustomerController::class, 'show']);
