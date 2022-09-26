<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "id" => $this->id,
            "date_order" => $this->order_at,
            "customer"  => New UserResource($this->customer),
            "beneficiary" => New UserResource($this->beneficiary),
            "products" => ProductResource::collection($this->products),

        ];
    }
}
