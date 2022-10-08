<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class RequestVoucherOnSite extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id"                        => "required|exists:App\Models\Script,id",
            "customer"                  => "required|array",
            "customer.firstName"        => "required|string",
            "customer.lastName"         => "required|string",
            "customer.tel"              => "required|string|max:10",
            "customer.email"            => "required|email",
            "beneficiary"               => "required|array",
            "beneficiary.firstName"     => "required|string",
            "beneficiary.lastName"      => "required|string",
            "beneficiary.tel"           => "required|string|max:10",
            "personalization"           => "required|array",
            "personalization.color"     => "required|exists:App\Models\Color,id",
            "personalization.font"      => "required|exists:App\Models\Font,id",
            "personalization.image"     => "required|exists:App\Models\Image,id",
            "personalization.message"   => "required|string",
            "gifts"                     => "required|array",
            "shipping"                  => "required|exists:App\Models\ShippingMethod,id",
            "payment"                   => "required|exists:App\Models\PaiementMethod,id",
            "total"                     => "required|numeric"
        ];
    }
}
