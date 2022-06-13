<?php

namespace App\Http\Resources\post;

use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Support\Facades\URL;
use App\Http\Resources\tag\TagResource;
use App\Http\Resources\post\FliteredPosts;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowingsResource extends JsonResource
{



    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */



    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */



    public function toArray($request)
    {
        $arr = [];
        if ($this->followable_type == 'App\Models\Seller') {

            $seller = Seller::find($this->followable_id);
            foreach ($seller->posts as $post) {
                $arr += [
                    'id' => $post->id,
                    'description' => $post->description,
                    'image_url' => $post->post_img ? URL::to('images/posts/' . $post->post_img) : null,
                    'tags' => TagResource::collection($post->tags),
                    'comments_count' => $post->comments->count(),
                    'updated_at' => $post->updated_at,
                    'created_by' => [
                        "type" => "seller",
                        "id" => $post->seller_id,
                        "name" => $post->seller->name,
                        "image_url" => $post->seller->seller_img ? URL::to('images/sellers/' . $post->seller->seller_img) : null
                    ]
                ];
            }
        } elseif ($this->followable_type == 'App\Models\Customer') {

            $customer = Customer::find($this->followable_id);
            foreach ($customer->posts as $post) {
                $arr += [
                    'id' => $post->id,
                    'description' => $post->description,
                    'image_url' => $post->post_img ? URL::to('images/posts/' . $post->post_img) : null,
                    'tags' => TagResource::collection($post->tags),
                    'comments_count' => $post->comments->count(),
                    'updated_at' => $post->updated_at,
                    'created_by' => [
                        "type" => "customer",
                        "id" => $post->customer_id,
                        "name" => $post->customer->name,
                        "image_url" => $post->customer->customer_img ? URL::to('images/customers/' . $post->customer->customer_img) : null
                    ]
                ];
            }
        }
        return $arr;
    }
}
