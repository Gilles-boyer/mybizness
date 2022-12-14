<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class FontStoreRequest extends BaseRequest
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
            "font" => "required|string|url"
        ];
    }
}
