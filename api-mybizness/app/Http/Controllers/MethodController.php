<?php

namespace App\Http\Controllers;

use App\Models\Method;
use App\Http\Controllers\Utility;
use App\Http\Utilities\CommentUtility;
use App\Http\Resources\MethodRessource;
use App\Http\Requests\StoreMethodRequest;
use App\Http\Resources\ClassNameResource;
use App\Http\Controllers\RoleMethodController;

class MethodController extends Controller
{
    protected static MethodController $object;

    /**
     * Display a listing of the resource Method
     *
     * @param  App\Http\Resources\ClassNameResource  $class
     * @return App\Http\Resources\MethodRessource
     */
    public static function processingMethod(ClassNameResource $class): ?object
    {
        $method = self::$object = new MethodController();
        $Class = $method->getClassWithNamespace($class["class_patch"]);
        $listMethod = array_diff(get_class_methods(new $Class), Utility::$methodsExclud);
        self::checkForUpdateListOfMethods($class['id'], $listMethod);

        foreach ($listMethod as $value) {
            $comment = CommentUtility::isObservableMethod($Class, $value, $class['id']);
            if ($comment) {
                //check object
                $ObjectMethod = self::$object->showByNameMethodAndClassId($value, $class['id']);

                //configure
                $request = StoreMethodRequest::create("", 'GET', [
                    "name"        => $comment['Name'],
                    "description" => $comment['Description'],
                    "method"      => $value,
                    "fk_class_id" => $class['id']
                ]);

                if (!$ObjectMethod) {
                    $ObjectMethod = new Method();
                }

                $data = $method->configureMethodForSave($ObjectMethod, $request);

                RoleMethodController::processingRelationMethodRole($data);
                ApplicationMethodController::processingRelationMethodApp($data);
            }
        }
        return MethodRessource::collection($class->methods);
    }

    /**
     * check collection bdd method for specific class and compare with list in php code and update list
     *
     * @param  int  $fk_class_id
     * @param  array $listClassMethod
     * @return void
     */
    protected static function checkForUpdateListOfMethods(int $fk_class_id, array $listClassMethod): void
    {
        $listMethod = Method::where("fk_class_id", $fk_class_id)->get();

        foreach ($listMethod as $method) {
            $test = false;
            foreach ($listClassMethod as $classMethod) {
                if ($method->method == $classMethod) {
                    $test = true;
                }
            }
            if (!$test) {
                $method->forceDelete();
            }
        }
    }

    /**
     * configure object method for to save
     *
     * @param  \App\Http\Model\Method  $method
     * @param  \App\Http\Requests\StoreMethodRequest $request
     * @return App\Models\Method
     */
    public function configureMethodForSave(Method $method, StoreMethodRequest $request)
    {
        $method->name        = $request->name;
        $method->description = $request->description;
        $method->method      = $request->method;
        $method->fk_class_id = $request->fk_class_id;
        $method->save();

        return $method;
    }

    /**
     * Display the specified Method by method name and class id.
     *
     * @param  string $method
     * @param  int    $class_id
     * @return \Illuminate\Http\Response
     */
    public function showByNameMethodAndClassId(string $method, int $class_id): ?object
    {
        return Method::where(["fk_class_id" => $class_id, "method" => $method])->first();
    }


    /**
     * delete method with name method and class id
     *
     * @param  string  $method
     * @param  int     $class_id
     * @return void
     */
    public static function delete(string $method, int $class_id): void
    {
        $methodClass = self::$object->showByNameMethodAndClassId($method, $class_id);
        if ($methodClass) {
            $methodClass->forceDelete();
        }
    }
}
