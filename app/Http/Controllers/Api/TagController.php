<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\post\FliteredPosts;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = DB::table('tags')
            ->select('id', 'name')
            ->get();

        return response()->json([
            'tags' => $tags,
            'status' => 200
        ]);
    }

    public function fliterPostsByTag($tag_id)
    {
        $tag = Tag::find($tag_id);

        if (!$tag) {
            return response()->json([
                'message' => "tag not found",
                'status' => 404
            ]);
        }

        if (Auth::guard('seller-api')->check() || Auth::guard('customer-api')->check()) {

            return response()->json([
                'posts' => FliteredPosts::collection($tag->posts),
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
        $tag = Tag::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'tag is created successfully',
            'tag' => $tag->name,
            'status' => 201
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
