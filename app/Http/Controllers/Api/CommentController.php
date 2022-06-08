<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\comment\CommentResource;

class CommentController extends Controller
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

    public function viewPostComments($post_id)
    {

        $post = Post::find($post_id);

        if (!$post) {
            return response()->json([
                'message' => "post not found",
                'status' => 404
            ]);
        }

        if (Auth::guard('seller-api')->check() || Auth::guard('customer-api')->check()) {

            return response()->json([
                'comments' => CommentResource::collection($post->comments),
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
    public function store(Request $request, $post_id)
    {

        $post = Post::find($post_id);

        if (!$post) {
            return response()->json([
                'message' => "post not found",
                'status' => 404
            ]);
        }

        $validator = Validator::make($request->all(), [
            'comment_text' => 'required|min:5|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'status' => 400
            ]);
        }

        $seller_id = null;
        $customer_id = null;
        $arrayData = null;
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

        $comment = Comment::create([
            'comment_text' => $request->comment_text,
            'seller_id' => $seller_id,
            'customer_id' => $customer_id,
            'post_id' => $post_id,
        ]);

        $arrayData = [
            'id' => $comment->id,
            'comment_text' => $comment->comment_text,
            'post' => [
                'id' => $comment->post->id,
                'description' => $comment->post->description
            ]
        ];

        if (Auth::guard('seller-api')->check()) {
            $arrayData['type'] = 'seller';
            $arrayData['name'] = Auth::guard('seller-api')->user()->name;
        } elseif (Auth::guard('customer-api')->check()) {
            $arrayData['type'] = 'customer';
            $arrayData['name'] = Auth::guard('customer-api')->user()->name;
        }

        return response()->json([
            'message' => "comment is created successfully",
            'comment' => $arrayData,
            'status' => 201
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
