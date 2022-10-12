<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorStoreRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "string|required",
            "hex"  => "string|required|regex:/#?([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})/i"
        ];
    }
}
