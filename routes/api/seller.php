<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Seller\AuthController;
use App\Http\Controllers\Api\Seller\SellerController;
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

Route::post('/seller/register', [AuthController::class, 'register'])->name('sellerRegister');
Route::post('/seller/login', [AuthController::class, 'login'])->name('sellerLogin');


Route::group(['middleware' => 'auth:seller-api'], function () {

    Route::post('/seller/{seller_id}/update', [SellerController::class, 'update']);
    Route::post('/seller/{seller_id}/image/delete', [SellerController::class, 'deleteSellerImage']);
    Route::post('/addAddress/seller/{seller_id}', [SellerController::class, 'addAddress']);
});
