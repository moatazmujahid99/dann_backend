<?php

namespace App\Http\Resources\post;

use Illuminate\Support\Facades\URL;
use App\Http\Resources\tag\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FliteredPosts extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $arrayData = [
            'id' => $this->id,
            'description' => $this->description,
            'image_url' => $this->post_img ? URL::to('images/posts/' . $this->post_img) : null,
            'tags' => TagResource::collection($this->tags),
            'comments_count' => $this->comments->count(),
            'updated_at' => $this->updated_at,
            'likes_count' => $this->followers()->count()
        ];

        if ($this->seller_id != null) {
            $arrayData['created_by'] = array(
                "type" => "seller",
                "id" => $this->seller_id,
                "name" => $this->seller->name,
                "image_url" => $this->seller->seller_img ? URL::to('images/sellers/' . $this->seller->seller_img) : null
            );
        } elseif ($this->customer_id != null) {
            $arrayData['created_by'] = array(
                "type" => "customer",
                "id" => $this->customer_id,
                "name" => $this->customer->name,
                "image_url" => $this->customer->customer_img ? URL::to('images/customers/' . $this->customer->customer_img) : null
            );
        }

        return $arrayData;
    }
}
