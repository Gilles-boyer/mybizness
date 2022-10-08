<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class RequestVoucherOnLine  extends BaseRequest
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
            "beneficiary"               => "required|json",
            "token"                     => "required|exists:App\Models\Application,app_token",
            "gifts"                     => "required|json",
            "total"                     => "required|numeric",
            "personalization"           => "required|json",
            "shipping"                  => "required|exists:App\Models\ShippingMethod,id",
        ];
    }
}
