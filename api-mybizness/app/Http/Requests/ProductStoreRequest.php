<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class ProductStoreRequest extends BaseRequest
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
            "img" =>"required|string|url",
            "price" => "required|string",
            "category_id" => "required|exists:App\Models\Category,id"
        ];
    }
}
