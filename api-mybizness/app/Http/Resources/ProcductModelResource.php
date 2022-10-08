<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcductModelResource extends JsonResource
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
            "name" => $this->product_name,
            "description" => $this->product_description,
            "img" => $this->product_img,
            "price" => $this->product_price,
            "online" => $this->product_online,
            "category" => new CategoryResource($this->category),
        ];
    }
}
