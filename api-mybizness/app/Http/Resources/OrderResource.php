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
        if($this->fk_app_id){
            $created_by =  new OrderAppResource($this->app);
        }else{
            $created_by = new OrderUserResource($this->staff);
        }

        return [
            "id" => $this->id,
            "date_order" => $this->order_at,
            "customer"  => New OrderClientResource($this->customer),
            "beneficiary" => New OrderClientResource($this->beneficiary),
            "products" => OrderProductResource::collection($this->products),
            "created_by" => $created_by,
            "total" =>  $this->order_total,
            "payment" => new OrderPaymentResource($this->payment),
            "voucher" => new OrderVoucherResource($this->voucher)
        ];
    }
}
