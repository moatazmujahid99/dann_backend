<?php

namespace App\Http\Resources\customer;

use App\Models\Customer;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomersFollowings extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $customer = Customer::find($this->followable_id);
        return [
            'id' => $customer->id,
            'name' => $customer->name,
            'image_url' => $customer->customer_img ? URL::to('images/customers/' . $customer->customer_img) : null,
        ];
    }
}
