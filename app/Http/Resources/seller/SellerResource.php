<?php

namespace App\Http\Resources\seller;

use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

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
        $seller = Seller::find($this->id);
        $followings_count = $seller->followings()->whereFollowableType(Customer::class)->count() +
            $seller->followings()->whereFollowableType(Seller::class)->count();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number ?? null,
            'address' => $this->address ?? null,
            'category' => $this->category->name ?? null,
            'image_url' => $this->seller_img ? URL::to('images/sellers/' . $this->seller_img) : null,
            'posts_count' => $this->posts->count(),
            'products_count' => 0,
            'followers_count' => $this->followers()->count(),
            'followings_count' => $followings_count,
        ];
    }
}
