<?php

namespace App\Http\Resources\customer;

use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

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
        $customer = Customer::find($this->id);
        $followings_count = $customer->followings()->whereFollowableType(Customer::class)->count() +
            $customer->followings()->whereFollowableType(Seller::class)->count();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'bio' => $this->bio ?? null,
            'image_url' => $this->customer_img ? URL::to('images/customers/' . $this->customer_img) : null,
            'posts_count' => $this->posts->count(),
            'followers_count' => $this->followers()->count(),
            'followings_count' => $followings_count,
        ];
    }
}
