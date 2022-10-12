<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Method;
use App\Http\Controllers\Utility;
use App\Http\Resources\MethodRessource;
use App\Http\Resources\ClassNameResource;
use App\Http\Controllers\RoleMethodController;
use App\Http\Resources\MethodModelResource;

class MethodController extends Controller
{
    protected static MethodController $object;

    /**
     * Display a listing of the resource Method
     *
     * @param  App\Http\Resources\ClassNameResource  $class
     * @return App\Http\Resources\MethodRessource
     */
    public static function processingMethod(ClassNameResource $class)
    {
        try {
            foreach (self::getMethods($class['class_patch']) as $method) {
                $comment = self::loadObservableMethod($class, $method);
                if ($comment) {
                    $comments = self::adapterMethod($comment['Name'], $comment['Description'], $method, $class['id']);
                    $Method = self::updateListMethod($method, $comments, $class);

                    RoleMethodController::processingRelationMethodRole($Method);
                    ApplicationMethodController::processingRelationMethodApp($Method);
                }
            }
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage());
        }

        return MethodRessource::collection($class->methods);
    }

    /**
     * update method
     * @param string $method
     * @param object $comments
     * @return void;
     */
    public static function updateListMethod(string $method, $comments, $class)
    {
        if (!self::methodExist($method, $class)) {
            $Method = new Method();
        } else {
            $Method = self::show($method, $class['id']);
        }
        return self::configureMethodForSave($Method, $comments);
    }

    /**
     * adapter method with data
     * @param string $name
     * @param string $description
     * @param string $method
     * @param int $classId
     * @return array
     */
    public static function adapterMethod(string $name, string $description, string $method, int $classId)
    {
        return [
            "name"          => ucfirst($name),
            "description"   => ucfirst($description),
            "method"        => $method,
            "fk_class_id"   => $classId
        ];
    }

    /**
     * load observable method
     * @param $class
     * @param $method
     * @return $comment
     */
    public static function loadObservableMethod($class, $method)
    {
        $comment = CommentController::getObservableMethod($class['class_patch'], $method);
        if (!$comment || $comment['Observable'] == "false") {
            if (self::methodExist($method, $class)) {
                self::show($method, $class['id'])->forceDelete();
            }
            return null;
        }
        return $comment;
    }

    /**
     * return specific method by name method
     *
     * @param  string   $method
     * @return \App\Http\Model\Method
     */
    public static function show(string $method, $classId): ?object
    {
        return  Method::where([
            "method"        => $method,
            "fk_class_id"   => $classId
        ])->first();
    }

    /**
     * Check if method exist in BDD
     *
     * @param  string  $method
     * @return boolean
     */
    public static function methodExist(string $method, $class): bool
    {
        if (self::show($method, $class['id'])) {
            return true;
        }
        return false;
    }

    /**
     * get list method for specific class name
     * @param string $class
     * @return array list method
     */
    public static function getMethods(string $class)
    {
        return array_diff(get_class_methods(new $class), Utility::$methodsExclud);
    }

    /**
     * configure object method for to save
     *
     * @param  \App\Http\Model\Method  $method
     * @param  array $comment
     * @return App\Models\Method
     */
    public static function configureMethodForSave(Method $method, $comment)
    {
        $method->name        = $comment['name'];
        $method->description = $comment['description'];
        $method->method      = $comment['method'];
        $method->fk_class_id = $comment['fk_class_id'];
        $method->save();
        return $method;
    }

    public function index()
    {
        return MethodModelResource::collection(Method::all());
    }
}
