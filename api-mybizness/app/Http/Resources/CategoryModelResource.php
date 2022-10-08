<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        {
            return [
                "id"        => $this->id,
                "name"      => $this->category_name,
                "products"  => CategoryProductResource::collection($this->productsOnline),
                "icon"      => $this->category_icon
            ];
        }
    }
}
