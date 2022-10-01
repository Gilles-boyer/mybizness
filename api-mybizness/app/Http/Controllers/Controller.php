<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static array $objects;

    /**
     * set link class name with namespace
     * @param string $class_name
     * @return string $object_class
     */
    public function getClassWithNamespace(string $class_name): string
    {
        $object =  __NAMESPACE__ . '\\' . $class_name;

        return $object;
    }

    /**
     * define rule validation id
     * @param string $model
     * @return array
     */
    public function ruleId(string $model)
    {
        return [
            "id" => "required|exists:App\Models\\$model,id"
        ];
    }

    /**
     * validate data id for specific model
     * @param array $request
     * @param string $model
     * @return Illuminate\Support\Facades\Validator
     */
    public function validateId(array $request, string $model)
    {
        return Validator::make(
            $request,
            $this->ruleId($model),
            Utility::$errors
        );
    }
}
