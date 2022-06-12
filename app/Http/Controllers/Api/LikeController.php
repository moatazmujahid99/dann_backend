<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\like\LikeResouce;

class LikeController extends Controller
{
    public function likePost($post_id)
    {

        $post = Post::find($post_id);

        if (!$post) {
            return response()->json([
                'message' => "post not found",
                'status' => 404
            ]);
        }


        if (Auth::guard('seller-api')->check()) {
            $loggedInSeller_id = Auth::guard('seller-api')->user()->id;
            $loggedInSeller = Seller::find($loggedInSeller_id);
            $loggedInSeller->follow($post);
        } elseif (Auth::guard('customer-api')->check()) {
            $loggedInCustomer_id = Auth::guard('customer-api')->user()->id;
            $loggedInCustomer = Customer::find($loggedInCustomer_id);
            $loggedInCustomer->follow($post);
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ]);
        }


        return response()->json([
            "message" => "you like this post",
            "status" => 200
        ]);
    }

    public function unlikePost($post_id)
    {

        $post = Post::find($post_id);

        if (!$post) {
            return response()->json([
                'message' => "post not found",
                'status' => 404
            ]);
        }


        if (Auth::guard('seller-api')->check()) {
            $loggedInSeller_id = Auth::guard('seller-api')->user()->id;
            $loggedInSeller = Seller::find($loggedInSeller_id);
            $loggedInSeller->unfollow($post);
        } elseif (Auth::guard('customer-api')->check()) {
            $loggedInCustomer_id = Auth::guard('customer-api')->user()->id;
            $loggedInCustomer = Customer::find($loggedInCustomer_id);
            $loggedInCustomer->unfollow($post);
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ]);
        }


        return response()->json([
            "message" => "you unlike this post",
            "status" => 200
        ]);
    }

    public function isLikePost($post_id)
    {

        $post = Post::find($post_id);

        if (!$post) {
            return response()->json([
                'message' => "post not found",
                'status' => 404
            ]);
        }


        if (Auth::guard('seller-api')->check()) {
            $loggedInSeller_id = Auth::guard('seller-api')->user()->id;
            $loggedInSeller = Seller::find($loggedInSeller_id);
            if ($loggedInSeller->isFollowing($post)) {
                return response()->json([
                    "message" => "you like this post",
                    "status" => 200
                ]);
            } else {
                return response()->json([
                    "message" => "you don't like this post",
                    "status" => 200
                ]);
            }
        } elseif (Auth::guard('customer-api')->check()) {
            $loggedInCustomer_id = Auth::guard('customer-api')->user()->id;
            $loggedInCustomer = Customer::find($loggedInCustomer_id);
            if ($loggedInCustomer->isFollowing($post)) {
                return response()->json([
                    "message" => "you like this post",
                    "status" => 200
                ]);
            } else {
                return response()->json([
                    "message" => "you don't like this post",
                    "status" => 200
                ]);
            }
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ]);
        }
    }

    public function getUsersLikePost($post_id)
    {

        $post = Post::find($post_id);

        if (!$post) {
            return response()->json([
                'message' => "post not found",
                'status' => 404
            ]);
        }

        if (Auth::guard('seller-api')->check() || Auth::guard('customer-api')->check()) {

            if ($post->followers->count() > 0) {
                $likers = $post->followers()
                    ->orderBy('updated_at', 'DESC')
                    ->get();

                return response()->json([
                    'likers' => LikeResouce::collection($likers),
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    "likers" => [],
                    "status" => 200
                ]);
            }
        } else {

            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ]);
        }
    }
}
