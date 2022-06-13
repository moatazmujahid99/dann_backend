<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\customer\AuthController;
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

Route::post('customer/register', [AuthController::class, 'register'])->name('customerRegister');
Route::post('customer/login', [AuthController::class, 'login'])->name('customerLogin');


Route::group(['middleware' => 'auth:customer-api'], function () {
    Route::post('/customer/{customer_id}/update', [CustomerController::class, 'update']);
    Route::post('/customer/{customer_id}/image/delete', [CustomerController::class, 'deleteCustomerImage']);
});
