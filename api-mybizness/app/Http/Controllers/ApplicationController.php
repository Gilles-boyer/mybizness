<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;

class ApplicationController extends Controller
{
    public function index()
    {
        return "hello";
    }
    public static function verifyTokenValidity(string $token, string $host)
    {
        $token = trim($token);
        $token = htmlspecialchars($token);
        $app = Application::where("app_token", $token)->first();
        if($app){
            return self::compareHost($app,$host);
        }
        return false;
    }

    public static function verifToken(string $token)
    {
        $validator = Validator::make(
            [
                'token' => $token,
            ],
            [
                'token' => "required|string|exists:App\Models\Application,app_token",
            ],
            Utility::$errors
        );
        if ($validator->fails()) {
            return Utility::responseError(
                $validator->errors(),
                "echec validation"
            );
        }

        $app = Application::where('app_token', $token)->first();

        return $app;
    }

    private static function compareHost(Application $app, string $host)
    {
        if($app->app_host == $host){
            return true;
        }
        return false;
    }
}
