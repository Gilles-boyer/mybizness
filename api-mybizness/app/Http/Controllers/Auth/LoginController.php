<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Utility;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request = (object)$request->validated();
        if(Auth::attempt(['user_email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();

            $success['token'] =  $user->createToken($user->user_email)->plainTextToken;
            $success['name'] =  $user->user_first_name." ".$user->user_last_name;
            $success['id'] = $user->id;

            return Utility::responseValid("success login", $success);
        } else {
            return Utility::responseError([],'echec login');
        }
    }

    public function logout() {
        try {
            auth()->user()->tokens()->delete();
        } catch (Exception $e) {
           return Utility::responseError($e->getMessage() ,"Error logout");
        }
        return Utility::responseValid("Logged out");
    }
}
