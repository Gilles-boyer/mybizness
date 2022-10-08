<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderVoucherResource extends JsonResource
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
            "id"        => $this->id,
            "num"       => $this->voucher_num,
            "validity"  => $this->voucher_validity,
            "message"   => $this->voucher_message,
            "color"     => new ColorOnlineResource($this->color),
            "font"      => new FontOnlineResource($this->font),
            "image"     => new ImageOnlineResource($this->image)
        ];
    }
}
