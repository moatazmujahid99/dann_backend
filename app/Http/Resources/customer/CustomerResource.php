<?php

namespace App\Http\Resources\customer;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class CustomerResource extends JsonResource
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
            'bio' => $this->bio ?? null,
            'image_url' => $this->customer_img ? URL::to('images/customers/' . $this->customer_img) : null,
            'posts_count' => 0,
            'followers_count' => 0,
            'followings_count' => 0,
        ];
    }
}
