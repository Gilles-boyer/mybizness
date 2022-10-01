<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationMethod;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\ApplicationMethodRequest;

class ApplicationMethodController extends Controller
{
    /**
     * check if relation exist between app and method. This function create
     * and update for refresh list ACL for app
     *
     * @param App\Models\Method $method
     * @return void
     */
    public static function processingRelationMethodApp($method): void
    {
        if ($method) {
            $appMethods = ApplicationMethod::where("fk_method_id", $method->id)->get();
            $checkArray = ((array)$appMethods)["\x00*\x00items"];

            if ($appMethods) {
                if ($checkArray == []) {
                    self::createRelationBaseForMethodApp($method->id);
                } elseif (count($checkArray) > 0) {
                    self::updateRelationBaseForMethodApp($appMethods);
                }
            }
        }
    }

    /**
     * Store a newly created ApplicationMethod in storage.
     *
     * @param int $fk_app_id
     * @param int $fk_method_id
     * @param string $role_name
     * @return App\Models\ApplicationMethod
     */
    public static function store(int $fk_app_id, int $fk_method_id): ApplicationMethod
    {
        $appMethod = new ApplicationMethod();

        $appMethod->fk_app_id = $fk_app_id;
        $appMethod->fk_method_id = $fk_method_id;

        $appMethod->save();

        return $appMethod;
    }

    /**
     * create all object ApplicationMethod for define relation between app and Method
     *
     * @param int $method_id
     * @return void
     */
    public static function createRelationBaseForMethodApp(int $method_id): void
    {
        $apps = Application::all();
        foreach ($apps as $app) {
            self::store($app->id, $method_id, $app->role_name);
        }
    }

    /**
     * create all object ApplicationMethod for update relation between app and Method
     *
     * @param Illuminate\Database\Eloquent\Collection $appMethods
     * @return void
     */
    public static function  updateRelationBaseForMethodApp(Collection $appMethods): void
    {
        $apps = Application::all();

        foreach ($apps as $app) {
            foreach ($appMethods as $roleMethod) {
                if (
                    !ApplicationMethod::where(
                        [
                            "fk_method_id" => $roleMethod->fk_method_id,
                            "fk_app_id" => $app->id
                        ]
                    )->first()
                ) {
                    self::store($app->id, $roleMethod->fk_method_id);
                }
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ApplicationMethodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ApplicationMethodRequest $request)
    {
        $methodApp = ApplicationMethod::where(
            [
                "fk_app_id" => $request->app_id,
                "fk_method_id" => $request->method_id
            ]
        )->first();

        $methodApp->activate = !$methodApp->activate;

        if ($methodApp->save()) {
            return Utility::responseValid("les droits ont été mis à jour");
        } else {
            return Utility::responseError([], "un problème est survenu lors de la mis à jour du droit app");
        }
    }
}
