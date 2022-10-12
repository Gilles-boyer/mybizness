<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'    => 'required|string|max:50',
            'last_name'     => 'required|string|max:50',
            'phone'         => 'required|string|min:10|max:10|regex:/^[0-9]*$/|unique:users,user_email',
            'email'         => 'required|email|unique:users,user_email',
            'role_id'       => "required|exists:App\Models\Role,id"
        ];
    }
}
