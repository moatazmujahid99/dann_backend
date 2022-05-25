<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\customer\AuthController;
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

Route::post('customer/register', [AuthController::class, 'register'])->name('customerRegister');
Route::post('customer/login', [AuthController::class, 'login'])->name('customerLogin');


Route::group(['prefix' => 'customer', 'middleware' => 'auth:customer-api'], function () {
    // authenticated staff routes here
    Route::get('', [AuthController::class, 'viewLoggedInCustomer']);
});
