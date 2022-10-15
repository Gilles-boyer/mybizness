<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class EmailTokenPasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "token" => "required|string|exists:password_resets,token",
            "password" => "required|string|min:8"
        ];
    }
}
