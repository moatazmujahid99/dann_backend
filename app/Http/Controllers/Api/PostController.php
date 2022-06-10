<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Seller;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Resources\tag\TagResource;
use App\Http\Resources\post\PostResource;
use App\Http\Resources\post\PostsDisplay;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function viewCustomerPosts($customer_id)
    {
        $customer = Customer::find($customer_id);

        if (!$customer) {
            return response()->json([
                'message' => "customer not found",
                'status' => 404
            ]);
        }

        if (Auth::guard('seller-api')->check() || Auth::guard('customer-api')->check()) {

            return response()->json([
                'posts' => PostsDisplay::collection($customer->posts),
                'customer' => [
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'image_url' => $customer->customer_img ? URL::to('images/customers/' . $customer->customer_img) : null
                ],
                'status' => 200
            ]);
        } else {

            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ]);
        }
    }

    public function viewSellerPosts($seller_id)
    {
        $seller = Seller::find($seller_id);

        if (!$seller) {
            return response()->json([
                'message' => "seller not found",
                'status' => 404
            ]);
        }

        if (Auth::guard('seller-api')->check() || Auth::guard('customer-api')->check()) {


            return response()->json([
                'posts' => PostsDisplay::collection($seller->posts),
                'seller' => [
                    'id' => $seller->id,
                    'name' => $seller->name,
                    'image_url' => $seller->seller_img ? URL::to('images/sellers/' . $seller->seller_img) : null
                ],
                'status' => 200
            ]);
        } else {

            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|min:5|max:2000',
            'post_img' => 'image|max:5050|nullable|mimes:jpg,jpeg,png',
            "tag_ids"    => "nullable|array",
            "tag_ids.*"  => "required|integer|distinct|exists:tags,id",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'status' => 400
            ]);
        }

        if (isset($request->post_img)) {
            // $imageName = time() . '-' . 'image' . rand() .  '.' . $request->post_img->extension();
            // $request->post_img->move(public_path('images/posts'), $imageName);
            $image = $request->file('post_img');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            File::makeDirectory('images/posts');
            Image::make($image)->save('images/posts/' . $name_gen);
        } else {
            $name_gen = null;
        }

        $seller_id = null;
        $customer_id = null;

        if (Auth::guard('seller-api')->check()) {
            $seller_id = Auth::guard('seller-api')->user()->id;
        } elseif (Auth::guard('customer-api')->check()) {
            $customer_id = Auth::guard('customer-api')->user()->id;
        } else {
            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ]);
        }

        $post = Post::create([
            'description' => $request->description,
            'post_img' => $name_gen,
            'seller_id' => $seller_id,
            'customer_id' => $customer_id,

        ]);

        $post->tags()->attach($request->tag_ids);

        return response()->json([
            'message' => "post is created successfully",
            'post' => new PostResource($post),
            'status' => 201
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => "post not found",
                'status' => 404
            ]);
        }

        if (Auth::guard('seller-api')->check() || Auth::guard('customer-api')->check()) {

            return response()->json([
                'post' => [
                    'id' => $post->id,
                    'description' => $post->description,
                    'image_url' => $post->post_img ? URL::to('images/posts/' . $post->post_img) : null,
                    'tags' => TagResource::collection($post->tags),
                ],
                'status' => 200
            ]);
        } else {

            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => "post not found",
                'status' => 404
            ]);
        }

        $validator = Validator::make($request->all(), [
            'description' => 'required|string|min:5|max:2000',
            'post_img' => 'image|max:5050|nullable|mimes:jpg,jpeg,png',
            "tag_ids"    => "nullable|array",
            "tag_ids.*"  => "required|integer|distinct|exists:tags,id",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'status' => 400
            ]);
        }

        if (!(Auth::guard('seller-api')->check() || Auth::guard('customer-api')->check())) {

            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ]);
        }

        if ((Auth::guard('seller-api')->check() && $post->seller_id == null)
            || (Auth::guard('customer-api')->check() && $post->customer_id == null)
        ) {
            return response()->json([
                "message" => "Unauthenticated",
                "status" => 401
            ]);
        } else {
            if (Auth::guard('seller-api')->check()) {
                if (Auth::guard('seller-api')->user()->id != $post->seller_id) {
                    return response()->json([
                        "message" => "You are not authorized to update this post",
                        "status" => 403
                    ]);
                }
            } elseif (Auth::guard('customer-api')->check()) {
                if (Auth::guard('customer-api')->user()->id != $post->customer_id) {
                    return response()->json([
                        "message" => "You are not authorized to update this post",
                        "status" => 403
                    ]);
                }
            }
        }

        if (isset($request->post_img)) {
            // $imageName = time() . '-' . 'image' . rand() .  '.' . $request->post_img->extension();
            // $request->post_img->move(public_path('images/posts'), $imageName);
            $image = $request->file('post_img');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            if (!File::exists('images/posts')) {
                File::makeDirectory('images/posts');
            }
            Image::make($image)->save('images/posts/' . $name_gen);

            if (isset($post->post_img)) {
                $imagePath = public_path('images/posts/' . $post->post_img);
                File::delete($imagePath);
            }
            $post->update([
                'post_img' => $name_gen,

            ]);
        }

        $post->update([
            'description' => $request->description,
        ]);


        $post->tags()->sync($request->tag_ids);

        return response()->json([
            'message' => "post is updated successfully",
            'post' => new PostResource($post),
            'status' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => "post not found",
                'status' => 404
            ]);
        }


        if (!(Auth::guard('seller-api')->check() || Auth::guard('customer-api')->check())) {

            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ]);
        }

        if ((Auth::guard('seller-api')->check() && $post->seller_id == null)
            || (Auth::guard('customer-api')->check() && $post->customer_id == null)
        ) {
            return response()->json([
                "message" => "Unauthenticated",
                "status" => 401
            ]);
        } else {
            if (Auth::guard('seller-api')->check()) {
                if (Auth::guard('seller-api')->user()->id != $post->seller_id) {
                    return response()->json([
                        "message" => "You are not authorized to delete this post",
                        "status" => 403
                    ]);
                }
            } elseif (Auth::guard('customer-api')->check()) {
                if (Auth::guard('customer-api')->user()->id != $post->customer_id) {
                    return response()->json([
                        "message" => "You are not authorized to delete this post",
                        "status" => 403
                    ]);
                }
            }
        }

        if (isset($post->post_img)) {
            $imagePath = public_path('images/posts/' . $post->post_img);
            File::delete($imagePath);
        }

        $post->delete();

        return response()->json([
            'message' => "post is deleted successfully",
            'deleted_post' => new PostResource($post),
            'status' => 200
        ]);
    }
}
