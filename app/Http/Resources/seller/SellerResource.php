<?php

namespace App\Http\Resources\seller;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class SellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number ?? null,
            'address' => $this->address ?? null,
            'category' => $this->category->name ?? null,
            'image_url' => $this->seller_img ? URL::to('images/sellers/' . $this->seller_img) : null,
            'posts_count' => 0,
            'products_count' => 0,
            'followers_count' => 0,
            'followings_count' => 0,
        ];
    }
}
