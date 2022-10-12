<?php

namespace App\Http\Requests;


class ShippingRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|string",
            "description" => "required|string",
            "method_id" => "required|exists:App\Models\Method,id"
        ];
    }
}
