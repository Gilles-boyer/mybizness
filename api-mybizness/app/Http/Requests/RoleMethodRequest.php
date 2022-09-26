<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class RoleMethodRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "method_id" => "required|exists:App\Models\Method,id",
            "role_id"   => "required|exists:App\Models\Role,id",
        ];
    }
}
