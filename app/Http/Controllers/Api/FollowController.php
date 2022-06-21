<?php

namespace App\Http\Controllers\Api;

use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\seller\SellersFollowers;
use App\Http\Resources\seller\SellersFollowings;
use App\Http\Resources\customer\CustomersFollowers;
use App\Http\Resources\customer\CustomersFollowings;

class FollowController extends Controller
{
    public function followSeller($seller_id)
    {

        $seller = Seller::find($seller_id);

        if (!$seller) {
            return response()->json([
                'message' => "seller not found",
                'status' => 404
            ], 404);
        }


        if (Auth::guard('seller-api')->check()) {
            $loggedInSeller_id = Auth::guard('seller-api')->user()->id;
            if ($loggedInSeller_id == $seller_id) {
                return response()->json([
                    'message' => "you can't follow yourself",
                    'status' => 400
                ], 400);
            }
            $loggedInSeller = Seller::find($loggedInSeller_id);
            $loggedInSeller->follow($seller);
        } elseif (Auth::guard('customer-api')->check()) {
            $loggedInCustomer_id = Auth::guard('customer-api')->user()->id;
            $loggedInCustomer = Customer::find($loggedInCustomer_id);
            $loggedInCustomer->follow($seller);
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ], 401);
        }

        $followings_count = $seller->followings()->whereFollowableType(Customer::class)->count() +
            $seller->followings()->whereFollowableType(Seller::class)->count();
        return response()->json([
            "message" => "now you are following this shop",
            'followers_count' => $seller->followers()->count(),
            'followings_count' => $followings_count,
            "status" => 200
        ], 200);
    }

    public function followCustomer($customer_id)
    {
        $customer = Customer::find($customer_id);

        if (!$customer) {
            return response()->json([
                'message' => "customer not found",
                'status' => 404
            ], 404);
        }

        if (Auth::guard('seller-api')->check()) {
            $loggedInSeller_id = Auth::guard('seller-api')->user()->id;
            $loggedInSeller = Seller::find($loggedInSeller_id);
            $loggedInSeller->follow($customer);
        } elseif (Auth::guard('customer-api')->check()) {
            $loggedInCustomer_id = Auth::guard('customer-api')->user()->id;
            if ($loggedInCustomer_id == $customer_id) {
                return response()->json([
                    'message' => "you can't follow yourself",
                    'status' => 400
                ], 400);
            }
            $loggedInCustomer = Customer::find($loggedInCustomer_id);
            $loggedInCustomer->follow($customer);
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ], 401);
        }

        $followings_count = $customer->followings()->whereFollowableType(Customer::class)->count() +
            $customer->followings()->whereFollowableType(Seller::class)->count();
        return response()->json([
            "message" => "now you are following this customer",
            'followers_count' => $customer->followers()->count(),
            'followings_count' => $followings_count,
            "status" => 200
        ], 200);
    }

    public function unfollowSeller($seller_id)
    {

        $seller = Seller::find($seller_id);

        if (!$seller) {
            return response()->json([
                'message' => "seller not found",
                'status' => 404
            ], 404);
        }


        if (Auth::guard('seller-api')->check()) {
            $loggedInSeller_id = Auth::guard('seller-api')->user()->id;
            $loggedInSeller = Seller::find($loggedInSeller_id);
            $loggedInSeller->unfollow($seller);
        } elseif (Auth::guard('customer-api')->check()) {
            $loggedInCustomer_id = Auth::guard('customer-api')->user()->id;
            $loggedInCustomer = Customer::find($loggedInCustomer_id);
            $loggedInCustomer->unfollow($seller);
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ], 401);
        }

        $followings_count = $seller->followings()->whereFollowableType(Customer::class)->count() +
            $seller->followings()->whereFollowableType(Seller::class)->count();
        return response()->json([
            "message" => "now you are not following this shop",
            'followers_count' => $seller->followers()->count(),
            'followings_count' => $followings_count,
            "status" => 200
        ], 200);
    }

    public function unfollowCustomer($customer_id)
    {
        $customer = Customer::find($customer_id);

        if (!$customer) {
            return response()->json([
                'message' => "customer not found",
                'status' => 404
            ], 404);
        }

        if (Auth::guard('seller-api')->check()) {
            $loggedInSeller_id = Auth::guard('seller-api')->user()->id;
            $loggedInSeller = Seller::find($loggedInSeller_id);
            $loggedInSeller->unfollow($customer);
        } elseif (Auth::guard('customer-api')->check()) {
            $loggedInCustomer_id = Auth::guard('customer-api')->user()->id;
            $loggedInCustomer = Customer::find($loggedInCustomer_id);
            $loggedInCustomer->unfollow($customer);
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ], 401);
        }

        $followings_count = $customer->followings()->whereFollowableType(Customer::class)->count() +
            $customer->followings()->whereFollowableType(Seller::class)->count();
        return response()->json([
            "message" => "now you are not following this customer",
            'followers_count' => $customer->followers()->count(),
            'followings_count' => $followings_count,
            "status" => 200
        ], 200);
    }

    public function isfollowingSeller($seller_id)
    {

        $seller = Seller::find($seller_id);

        if (!$seller) {
            return response()->json([
                'message' => "seller not found",
                'status' => 404
            ], 404);
        }


        if (Auth::guard('seller-api')->check()) {
            $loggedInSeller_id = Auth::guard('seller-api')->user()->id;
            $loggedInSeller = Seller::find($loggedInSeller_id);
            if ($loggedInSeller->isFollowing($seller)) {
                return response()->json([
                    "message" => "you are following this shop",
                    "status" => 200
                ], 200);
            } else {
                return response()->json([
                    "message" => "you are not following this shop",
                    "status" => 200
                ], 200);
            }
        } elseif (Auth::guard('customer-api')->check()) {
            $loggedInCustomer_id = Auth::guard('customer-api')->user()->id;
            $loggedInCustomer = Customer::find($loggedInCustomer_id);
            if ($loggedInCustomer->isFollowing($seller)) {
                return response()->json([
                    "message" => "you are following this shop",
                    "status" => 200
                ], 200);
            } else {
                return response()->json([
                    "message" => "you are not following this shop",
                    "status" => 200
                ], 200);
            }
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ], 401);
        }
    }

    public function isfollowingCustomer($customer_id)
    {
        $customer = Customer::find($customer_id);

        if (!$customer) {
            return response()->json([
                'message' => "customer not found",
                'status' => 404
            ], 404);
        }

        if (Auth::guard('seller-api')->check()) {
            $loggedInSeller_id = Auth::guard('seller-api')->user()->id;
            $loggedInSeller = Seller::find($loggedInSeller_id);
            if ($loggedInSeller->isFollowing($customer)) {
                return response()->json([
                    "message" => "you are following this customer",
                    "status" => 200
                ], 200);
            } else {
                return response()->json([
                    "message" => "you are not following this customer",
                    "status" => 200
                ], 200);
            }
        } elseif (Auth::guard('customer-api')->check()) {
            $loggedInCustomer_id = Auth::guard('customer-api')->user()->id;
            $loggedInCustomer = Customer::find($loggedInCustomer_id);
            if ($loggedInCustomer->isFollowing($customer)) {
                return response()->json([
                    "message" => "you are following this customer",
                    "status" => 200
                ], 200);
            } else {
                return response()->json([
                    "message" => "you are not following this customer",
                    "status" => 200
                ], 200);
            }
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ], 401);
        }
    }

    public function followersTypeSeller()
    {

        if (Auth::guard('seller-api')->check()) {
            $loggedInSeller_id = Auth::guard('seller-api')->user()->id;
            $loggedInSeller = Seller::find($loggedInSeller_id);
            if ($loggedInSeller->followers()->whereFollowerType(Seller::class)->count() > 0) {
                $followers = $loggedInSeller->followers()->whereFollowerType(Seller::class)
                    ->orderBy('updated_at', 'DESC')
                    ->get();

                return response()->json([
                    "followers" => SellersFollowers::collection($followers),
                    "status" => 200
                ], 200);
            } else {
                return response()->json([
                    "followers" => [],
                    "status" => 200
                ], 200);
            }
        } elseif (Auth::guard('customer-api')->check()) {
            $loggedInCustomer_id = Auth::guard('customer-api')->user()->id;
            $loggedInCustomer = Customer::find($loggedInCustomer_id);
            if ($loggedInCustomer->followers()->whereFollowerType(Seller::class)->count() > 0) {
                $followers = $loggedInCustomer->followers()->whereFollowerType(Seller::class)
                    ->orderBy('updated_at', 'DESC')
                    ->get();

                return response()->json([
                    "followers" => SellersFollowers::collection($followers),
                    "status" => 200
                ], 200);
            } else {
                return response()->json([
                    "followers" => [],
                    "status" => 200
                ], 200);
            }
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ], 401);
        }
    }
    public function followersTypeCustomer()
    {

        if (Auth::guard('seller-api')->check()) {
            $loggedInSeller_id = Auth::guard('seller-api')->user()->id;
            $loggedInSeller = Seller::find($loggedInSeller_id);
            if ($loggedInSeller->followers()->whereFollowerType(Customer::class)->count() > 0) {
                $followers = $loggedInSeller->followers()->whereFollowerType(Customer::class)
                    ->orderBy('updated_at', 'DESC')
                    ->get();

                return response()->json([
                    "followers" => CustomersFollowers::collection($followers),
                    "status" => 200
                ], 200);
            } else {
                return response()->json([
                    "followers" => [],
                    "status" => 200
                ], 200);
            }
        } elseif (Auth::guard('customer-api')->check()) {
            $loggedInCustomer_id = Auth::guard('customer-api')->user()->id;
            $loggedInCustomer = Customer::find($loggedInCustomer_id);
            if ($loggedInCustomer->followers()->whereFollowerType(Customer::class)->count() > 0) {
                $followers = $loggedInCustomer->followers()->whereFollowerType(Customer::class)
                    ->orderBy('updated_at', 'DESC')
                    ->get();

                return response()->json([
                    "followers" => CustomersFollowers::collection($followers),
                    "status" => 200
                ], 200);
            } else {
                return response()->json([
                    "followers" => [],
                    "status" => 200
                ], 200);
            }
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ], 401);
        }
    }

    public function followingsTypeSeller()
    {

        if (Auth::guard('seller-api')->check()) {
            $loggedInSeller_id = Auth::guard('seller-api')->user()->id;
            $loggedInSeller = Seller::find($loggedInSeller_id);
            if ($loggedInSeller->followings()->whereFollowableType(Seller::class)->count() > 0) {
                $followings = $loggedInSeller->followings()->whereFollowableType(Seller::class)
                    ->orderBy('updated_at', 'DESC')
                    ->get();

                return response()->json([
                    "followings" => SellersFollowings::collection($followings),
                    "status" => 200
                ], 200);
            } else {
                return response()->json([
                    "followings" => [],
                    "status" => 200
                ], 200);
            }
        } elseif (Auth::guard('customer-api')->check()) {
            $loggedInCustomer_id = Auth::guard('customer-api')->user()->id;
            $loggedInCustomer = Customer::find($loggedInCustomer_id);
            if ($loggedInCustomer->followings()->whereFollowableType(Seller::class)->count() > 0) {
                $followings = $loggedInCustomer->followings()->whereFollowableType(Seller::class)
                    ->orderBy('updated_at', 'DESC')
                    ->get();

                return response()->json([
                    "followings" => SellersFollowings::collection($followings),
                    "status" => 200
                ], 200);
            } else {
                return response()->json([
                    "followings" => [],
                    "status" => 200
                ], 200);
            }
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ], 401);
        }
    }

    public function followingsTypeCustomer()
    {

        if (Auth::guard('seller-api')->check()) {
            $loggedInSeller_id = Auth::guard('seller-api')->user()->id;
            $loggedInSeller = Seller::find($loggedInSeller_id);
            if ($loggedInSeller->followings()->whereFollowableType(Customer::class)->count() > 0) {
                $followings = $loggedInSeller->followings()->whereFollowableType(Customer::class)
                    ->orderBy('updated_at', 'DESC')
                    ->get();

                return response()->json([
                    "followings" => CustomersFollowings::collection($followings),
                    "status" => 200
                ], 200);
            } else {
                return response()->json([
                    "followings" => [],
                    "status" => 200
                ], 200);
            }
        } elseif (Auth::guard('customer-api')->check()) {
            $loggedInCustomer_id = Auth::guard('customer-api')->user()->id;
            $loggedInCustomer = Customer::find($loggedInCustomer_id);
            if ($loggedInCustomer->followings()->whereFollowableType(Customer::class)->count() > 0) {
                $followings = $loggedInCustomer->followings()->whereFollowableType(Customer::class)
                    ->orderBy('updated_at', 'DESC')
                    ->get();

                return response()->json([
                    "followings" => CustomersFollowings::collection($followings),
                    "status" => 200
                ], 200);
            } else {
                return response()->json([
                    "followings" => [],
                    "status" => 200
                ], 200);
            }
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ], 401);
        }
    }


    public function get_followers($id)
    {
        $seller = Seller::find($id);
        $followers = $seller->followers()->get();

        return response()->json([
            'followers' => $followers,
            'number' => count($followers)
        ]);
    }
}
