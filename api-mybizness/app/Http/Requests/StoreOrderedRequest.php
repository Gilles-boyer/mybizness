<?php

namespace App\Http\Requests;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Utility;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreOrderedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_fisrtname' => "required|string",
            'client_lastname'  => "required|string",
            'client_email'     => "required|string",
            'client_phone'     => "required|string",
            'total'            => "required|string",
            'beneficiary'      => "required|string",
            'personalization'  => "required|string",
            'shipping_method'  => "required|string",
            'list_gifts'       => "required|string",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Utility::responseError($validator->errors()));
    }

        /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new HttpResponseException(Utility::responseError([], "connexion non autorisé"));
    }
}
