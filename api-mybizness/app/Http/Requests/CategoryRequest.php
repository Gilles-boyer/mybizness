<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class CategoryRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"          => "required|string",
            "description"   => "required|string",
            "icon"          => "required|string|regex:/^mdi-/i"
        ];
    }
}
