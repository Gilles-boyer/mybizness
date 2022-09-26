<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserClientRequest;

Class RequestAdapter
{
    /**
     * configure Request for model User
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $phone
     * @param string $email=""
     *
     * @return UserClientRequest
     */
    static function userRequest(string $first_name, string $last_name, string $phone, string $email="")
    {
        return  UserClientRequest::create("", 'GET', [
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'phone'      => $phone,
            'email'      => $email
        ]);
    }


}
