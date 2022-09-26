<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class ArrayRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "script_methods" => "required|array",
        ];
    }
}
