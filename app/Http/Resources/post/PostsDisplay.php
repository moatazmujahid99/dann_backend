<?php

namespace App\Http\Resources\post;

use Illuminate\Support\Facades\URL;
use App\Http\Resources\tag\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsDisplay extends JsonResource
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
            'likes_count' => $this->followers()->count(),
        ];

        return $arrayData;
    }
}
