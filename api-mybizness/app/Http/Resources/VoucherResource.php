<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResource extends JsonResource
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
            "color"     => $this->voucher_color,
            "font"      => $this->voucher_font,
            "theme"     => new VoucherThemeResource($this->theme),
            "order"     => new VoucherOrderResource($this->order),
        ];
    }
}
