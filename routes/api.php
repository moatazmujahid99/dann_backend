<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Moataz
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\LikeController;


// omar - check
use App\Http\Controllers\User\ResetController;
use App\Http\Controllers\User\ForgetController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SliderController;

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\SellerCategoryController;
use App\Http\Controllers\Admin\FavouriteController;
use App\Http\Controllers\Admin\NewCategoryController;
use App\Http\Controllers\Admin\ProductCartController;


use App\Http\Controllers\Admin\ProductListController;
use App\Http\Controllers\Api\Seller\SellerController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Api\Customer\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Moataz

//-----------(seller or customer) only can access those routes------------

//sellers
Route::get('/sellers', [SellerController::class, 'index']);
Route::get('/seller/{seller_id}', [SellerController::class, 'show']);

//customers
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customer/{customer_id}', [CustomerController::class, 'show']);

//--------------anyone acccess those routes-------------------

//check for who is logged in
Route::get('/who_loggedin', function (Request $request) {

    if (Auth::guard('seller-api')->check()) {
        return response()->json([
            'message' => "seller"
        ]);
    } elseif (Auth::guard('customer-api')->check()) {
        return response()->json([
            'message' => "customer",
        ]);
    } else {
        return response()->json([
            'message' => "invalid token",

        ]);
    }
});

// sellers categories
Route::post('/create/category/for_sellers', [SellerCategoryController::class, 'store']);
Route::get('/sellers/categories', [SellerCategoryController::class, 'index']);


//posts
Route::post('/create/post', [PostController::class, 'store']);
Route::post('/post/{post_id}/update', [PostController::class, 'update']);
Route::post('/post/{post_id}/delete', [PostController::class, 'destroy']);
Route::get('/posts/seller/{seller_id}', [PostController::class, 'viewSellerPosts']);
Route::get('/posts/customer/{customer_id}', [PostController::class, 'viewCustomerPosts']);
Route::get('/post/{post_id}', [PostController::class, 'show']);
Route::get('/posts/tag/{tag_id}', [TagController::class, 'fliterPostsByTag']);


//tags
Route::post('/create/tag/', [TagController::class, 'store']);
Route::get('/tags', [TagController::class, 'index']);

//comments
Route::post('/create/comment/for_post/{post_id}', [CommentController::class, 'store']);
Route::get('/post/{post_id}/comments', [CommentController::class, 'viewPostComments']);

Route::post('/follow/seller/{seller_id}', [FollowController::class, 'followSeller']);
Route::post('/follow/customer/{customer_id}', [FollowController::class, 'followCustomer']);

Route::post('/unfollow/seller/{seller_id}', [FollowController::class, 'unfollowSeller']);
Route::post('/unfollow/customer/{customer_id}', [FollowController::class, 'unfollowCustomer']);

Route::get('/isfollowing/seller/{seller_id}', [FollowController::class, 'isfollowingSeller']);
Route::get('/isfollowing/customer/{customer_id}', [FollowController::class, 'isfollowingCustomer']);


Route::get('/followers/type/seller', [FollowController::class, 'followersTypeSeller']);
Route::get('/followers/type/customer', [FollowController::class, 'followersTypeCustomer']);

Route::get('/followings/type/seller', [FollowController::class, 'followingsTypeSeller']);
Route::get('/followings/type/customer', [FollowController::class, 'followingsTypeCustomer']);



//like

Route::post('/like/post/{post_id}', [LikeController::class, 'likePost']);

Route::post('/unlike/post/{post_id}', [LikeController::class, 'unlikePost']);

Route::get('/islike/post/{post_id}', [LikeController::class, 'isLikePost']);

Route::get('/likers/post/{post_id}', [LikeController::class, 'getUsersLikePost']);



/*

|-------------------------------------------------------------------------
| Omar
|-------------------------------------------------------------------------
*/
// check

//Visitor details api route
Route::get('/getvisitor', [VisitorController::class, 'GetVisitorDetails']);
//Contact page api route
Route::post('/postcontact', [ContactController::class, 'PostContactDetails']);



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


/////////////// User Login API Start ////////////////////////

// Login Routes
Route::post('/login', [AuthController::class, 'Login']);

// Register Routes
Route::post('/register', [AuthController::class, 'Register']);

// Forget Password Routes
Route::post('/forgetpassword', [ForgetController::class, 'ForgetPassword']);

// Reset Password Routes
Route::post('/resetpassword', [ResetController::class, 'ResetPassword']);

// Current User Route
Route::get('/user', [UserController::class, 'User'])->middleware('auth:api');


/////////////// End User Login API Start ////////////////////////






// Get Visitor
Route::get('/getvisitor', [VisitorController::class, 'GetVisitorDetails']);
// Contact Page Route
Route::post('/postcontact', [ContactController::class, 'PostContactDetails']);

// Site Infro Route
Route::get('/allsiteinfo', [SiteInfoController::class, 'AllSiteinfo']);

// All Category Route
Route::get('/allcategory', [NewCategoryController::class, 'AllCategory']);

// ProductList Route
Route::get('/productlistbyremark/{remark}', [ProductListController::class, 'ProductListByRemark']);

Route::get('/productlistbycategory/{category}', [ProductListController::class, 'ProductListByCategory']);

Route::get('/productlistbysubcategory/{category}/{subcategory}', [ProductListController::class, 'ProductListBySubCategory']);

// Slider Route
Route::get('/allslider', [SliderController::class, 'AllSlider']);

// Product Details Route
Route::get('/productdetails/{id}', [ProductDetailsController::class, 'ProductDetails']);

// Notification Route
Route::get('/notification', [NotificationController::class, 'NotificationHistory']);

// Search Route
Route::get('/search/{key}', [ProductListController::class, 'ProductBySearch']);

// Similar Product Route
Route::get('/similar/{subcategory}', [ProductListController::class, 'SimilarProduct']);


// Product Cart Route
Route::post('/addtocart', [ProductCartController::class, 'addToCart']);

// Cart Count Route
Route::get('/cartcount/{email}', [ProductCartController::class, 'CartCount']);


// Favourite Route
Route::get('/favourite/{product_code}/{email}', [FavouriteController::class, 'AddFavourite']);

Route::get('/favouritelist/{email}', [FavouriteController::class, 'FavouriteList']);

Route::get('/favouriteremove/{product_code}/{email}', [FavouriteController::class, 'FavouriteRemove']);

// Cart List Route
Route::get('/cartlist/{email}', [ProductCartController::class, 'CartList']);

Route::get('/removecartlist/{id}', [ProductCartController::class, 'RemoveCartList']);

Route::get('/cartitemplus/{id}/{quantity}/{price}', [ProductCartController::class, 'CartItemPlus']);

Route::get('/cartitemminus/{id}/{quantity}/{price}', [ProductCartController::class, 'CartItemMinus']);


// Cart Order Route
Route::post('/cartorder', [ProductCartController::class, 'CartOrder']);

Route::get('/orderlistbyuser/{email}', [ProductCartController::class, 'OrderListByUser']);

// Post Product Review Route
Route::post('/postreview', [ReviewController::class, 'PostReview']);

// Review Product Route
Route::get('/reviewlist/{product_code}', [ReviewController::class, 'ReviewList']);
