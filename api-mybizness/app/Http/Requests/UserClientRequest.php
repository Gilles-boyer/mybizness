<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Utility;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class UserClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validator = [
            'first_name'    => 'required|string|max:50',
            'last_name'     => 'required|string|max:50',
            'phone'         => 'required|string|min:10|max:10|regex:/^[0-9]*$/'
        ];

        if($this->type == "client") {
            $validator["email"] = 'required|email';
        }

        if($this->type == "staff") {
            $validator["password"] = 'required|string|max:20';
        }

        return $validator;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Utility::responseError($validator->errors()));
    }
}
