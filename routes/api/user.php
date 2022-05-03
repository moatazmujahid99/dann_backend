<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;
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

Route::post('user/register', [AuthController::class, 'register'])->name('userRegister');
Route::post('user/login', [AuthController::class, 'login'])->name('userLogin');


Route::group(['prefix' => 'user', 'middleware' => 'auth:user-api'], function () {
    // authenticated staff routes here
    Route::get('', [AuthController::class, 'viewLoggedInUser']);
});
