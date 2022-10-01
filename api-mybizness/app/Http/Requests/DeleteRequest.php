<?php

namespace App\Http\Requests;

use App\Http\Controllers\Utility;
use App\Http\Requests\BaseRequest;

class DeleteRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id" => "required|exists:App\Models\\$this->model,id"
        ];
    }
}
