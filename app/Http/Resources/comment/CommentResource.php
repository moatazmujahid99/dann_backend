<?php

namespace App\Http\Resources\comment;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'comment_text' => $this->comment_text,
            'created_at' => $this->created_at,
        ];

        if ($this->seller_id != null) {
            $arrayData['created_by'] = array(
                "type" => "seller",
                "id" => $this->seller_id,
                "name" => $this->seller->name,
                "image_url" => $this->seller->seller_img ? URL::to('images/sellers/' . $this->seller->seller_img) : null
            );
        } elseif ($this->customer_id != null) {
            $arrayData['created_by'] = array(
                "type" => "customer",
                "id" => $this->customer_id,
                "name" => $this->customer->name,
                "image_url" => $this->customer->customer_img ? URL::to('images/customers/' . $this->customer->customer_img) : null
            );
        }
        return $arrayData;
    }
}
