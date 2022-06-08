<?php

namespace App\Http\Resources\post;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\tag\TagResource;

class PostResource extends JsonResource
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
        ];
        if (Auth::guard('seller-api')->check()) {
            $arrayData['type'] = 'seller';
            $arrayData['name'] = Auth::guard('seller-api')->user()->name;
        } elseif (Auth::guard('customer-api')->check()) {
            $arrayData['type'] = 'customer';
            $arrayData['name'] = Auth::guard('customer-api')->user()->name;
        }
        return $arrayData;
    }
}
