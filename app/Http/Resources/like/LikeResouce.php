<?php

namespace App\Http\Resources\like;

use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $arr = [];
        if ($this->follower_type == 'App\Models\Seller') {
            $seller = Seller::find($this->follower_id);
            $arr += [
                'type' => 'seller',
                'id' => $seller->id,
                'name' => $seller->name,
                'category' => $seller->category->name ?? null,
                'image_url' => $seller->seller_img ? URL::to('images/sellers/' . $seller->seller_img) : null,
                'rating' => 0
            ];
        } elseif ($this->follower_type == 'App\Models\Customer') {
            $customer = Customer::find($this->follower_id);
            $arr += [
                'type' => 'customer',
                'id' => $customer->id,
                'name' => $customer->name,
                'image_url' => $customer->customer_img ? URL::to('images/customers/' . $customer->customer_img) : null,
            ];
        }
        return $arr;
    }
}
