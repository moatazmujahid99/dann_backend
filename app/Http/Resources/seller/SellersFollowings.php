<?php

namespace App\Http\Resources\seller;

use App\Models\Seller;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

class SellersFollowings extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $seller = Seller::find($this->followable_id);
        return [
            'id' => $seller->id,
            'name' => $seller->name,
            'category' => $seller->category->name ?? null,
            'image_url' => $seller->seller_img ? URL::to('images/sellers/' . $seller->seller_img) : null,
            'rating' => 0
        ];
    }
}
