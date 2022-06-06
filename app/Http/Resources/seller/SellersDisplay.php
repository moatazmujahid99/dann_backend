<?php

namespace App\Http\Resources\seller;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class SellersDisplay extends JsonResource
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
            'category' => $this->category->category_name ?? null,
            'image_url' => $this->seller_img ? URL::to('images/sellers/' . $this->seller_img) : null,
            'rating' => 0
        ];
    }
}
