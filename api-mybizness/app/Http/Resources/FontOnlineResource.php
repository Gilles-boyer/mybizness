<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FontOnlineResource extends JsonResource
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
            "name" => $this->font_name,
            "font" => $this->font_font
        ];
    }
}
