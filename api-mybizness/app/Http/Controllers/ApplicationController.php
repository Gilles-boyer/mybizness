<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ApplicationRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ApplicationResource;

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
        return Application::where("app_token", $token)->get();
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

    /**
     * Undocumented function
     *
     * @return mixed
     */
    public function index()
    {
        return ApplicationResource::collection(Application::all());
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicationRequest $request)
    {
        $validated = (object)$request->validated();
        $app = new Application();
        try {
            $newApp = $this->defineParamsApp($validated,$app);
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de création");
        }
        return Utility::responseValid("application créé",$newApp, 201);
    }

    /**
     * set param for to save model application
     *
     * @param object $params
     * @param Application $app
     * @return ApplicationResource
     */
    public function defineParamsApp(object $params,Application $app):ApplicationResource
    {
        $app->app_name  = $params->name;
        $app->app_host  = $params->host;
        $app->app_token = Crypt::encryptString(uniqid($params->name, true));
        $app->save();
        return  new ApplicationResource($app);
    }

    /**
     * Undocumented function
     *
     * @param Application $application
     * @return void
     */
    public function updateActivate(Application $application)
    {
        try{
            $application->app_activate =  !$application->app_activate;
            $application->save();
        }catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur modification application online");
        }
        return Utility::responseValid("online application modifiée");
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Font  $font
     * @return \Illuminate\Http\Response
     */
    public function update(ApplicationRequest $request, Application $application)
    {
        $validated = (object)$request->validated();
        try{
           $app = $this->defineParamsApp($validated, $application);
        }catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de modification");
        }
        return Utility::responseValid("application modifiée", new ApplicationResource($app));
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        try {
            $application->delete();
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de suppression");
        }
        return Utility::responseValid("application supprimée");
    }

}
