<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Application;
use Illuminate\Support\Facades\Validator;

/**
 * Observable : true
 * Name : Application
 * Description : list function for application controller
 */
class ApplicationController extends Controller
{
    protected array $ruleToken = [
        'token' => "required|string|exists:App\Models\Application,app_token",
        'host'  => "required|string|exists:App\Models\Application,app_host"
    ];


    /**
     * create validator token
     * @param string $token
     * @param string $host
     * @return Validator
     */
    public function validatorToken(string $token, string $host)
    {
        return Validator::make(
            [
                'token' => $token,
                'host'  => $host
            ],
            $this->ruleToken,
            Utility::$errors
        );
    }

    /**
     * validated data token
     * @param object $validator
     * @return validated
     */
    public function validatedToken($validator)
    {
        if ($validator->fails()) {
            return Utility::responseError(
                $validator->errors(),
                "echec validation"
            );
        }
        return $this->validated();
    }

    /**
     * get app by token
     * @param string $token
     * @return Application
     */
    public function getAppByToken(string $token)
    {
        return Application::where("app_token", $token)->first();
    }

    /**
     * verify validity token and compare host
     * @param string $token
     * @param string $host
     * @return Application
     */
    public function verifyTokenValidity(string $token, string $host)
    {
        $validate = $this->validatedToken($this->validatorToken($token, $host));
        $app = $this->getAppByToken($validate->token);
        if ($this->compareHost($app, $validate->host)); {
            return $app;
        }
        throw new Exception("Echec validation token");
    }

    /**
     * compare host
     * @param Application $app
     * @param string $host
     * @return Bool
     */
    private function compareHost(Application $app, string $host)
    {
        if ($app->app_host == $host) {
            return true;
        }
        return false;
    }

    /**
     * Observable : true
     * Name : get app
     * Description : app by token
     */
    public function loadAppByToken($request, $results)
    {
        $results['app'] = $this->getAppByToken($request->token);
        return $results;
    }
}
