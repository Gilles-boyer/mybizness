<?php

namespace App\Http\Requests\voucher;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Validator;


class StoreVoucherRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "theme"             => "required|exists:App\Models\Theme,id",
            "backgroundColor"   => "required|string",
            "fontFamily"        => "required|string",
            "message"           => "required|string",
            "order"             => "required|exists:App\Models\Order,id",
            "shipping"          => "required|exists:App\Models\ShippingMethod,id",
        ];
    }
}
