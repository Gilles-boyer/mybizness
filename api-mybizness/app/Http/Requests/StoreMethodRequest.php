<?php

namespace App\Http\Requests;

use App\Http\Controllers\Utility;
use App\Http\Requests\BaseRequest;

class StoreMethodRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Utility::ruleStoreMethod();
    }
}
