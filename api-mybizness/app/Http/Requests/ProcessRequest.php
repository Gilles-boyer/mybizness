<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class ProcessRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id"                => "required|exists:App\Models\Script,id",
            "customer"          => "required|string",
            "beneficiary"       => "required|string",
            "personalization"   => "required|string",
            "gifts"             => "required",
            "shipping"          => "required",
            "total"             => "required|numeric",
            "token"             => "required|exists:App\Models\Application,app_token"
        ];
    }
}
