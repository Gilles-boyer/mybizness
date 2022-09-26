<?php

namespace App\Http\Controllers;

class Utility
{
    public static $errors = [
        'required' => 'Le champs :attribute est requis',
        'string'   => 'Merci de saisir un string pour :attribute',
        'max'      => 'Merci de vérifier le nombre max de caractère pour :attribute',
        'min'      => 'Merci de vérifier le nombre min de caractère pour :attribute',
        'regex'    => "le format attendu pour :attribute n'est pas respecté",
        'email'    => "Merci de saisir une adresse mail valide",
        'exists'   => ":attribute l'object demandé n'existe pas",
        'unique'   => "merci de vérifier :attribute, car il existe déja",
        'numeric'  => "la valeur de :attribute doit être numeric",
        'array'    => "la valeur de :attribute doit être un array"
    ];

    public static $baseRule = [
        "name"        => "required|string",
        "description" => "required|string",
    ];

    public static $methodsExclud = [
        "middleware",
        "getMiddleware",
        "callAction",
        "__call",
        "authorize",
        "authorizeForUser",
        "parseAbilityAndArguments",
        "normalizeGuessedAbilityName",
        "authorizeResource",
        "resourceAbilityMap",
        "resourceMethodsWithoutModels",
        "dispatch",
        "dispatchNow",
        "dispatchSync",
        "validateWith",
        "validate",
        "validateWithBag",
        "getValidationFactory"
    ];

    /**
     * return model response json for error
     * @param   mixed  $errors
     * @param  string  $message = "Validation errors"
     * @param  int  $code = 422
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public static function responseError($errors, string $message = "Validation errors", int $code = 422): object
    {
        return response()->json([
            'success'    => false,
            'message'    => $message,
            'data'       => $errors
        ], $code);
    }

    /**
     * return model response json for error
     * @param  mixed $data
     * @param  string  $message
     * @param  int  $code = 200
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public static function responseValid(string $message, $data = [], int $code = 200): object
    {
        return response()->json([
            'success'    => true,
            'message'    => $message,
            'data'       => $data
        ], $code);
    }

    /**
     * add additional rule validation for store class
     *
     * @return array
     */
    public static function ruleStoreClassName(): array
    {
        return array_merge(self::$baseRule, array("class_patch" => "required|string|unique:class_names,class_patch"));
    }

    /**
     * add additional rule validation for store method
     *
     * @return array
     */
    public static function ruleStoreMethod(): array
    {
        return array_merge(self::$baseRule, array(
            "method" => "required|string",
            "fk_class_id" => "required|exists:App\Models\ClassName,id"
        ));
    }

    /**
     * check variable exist and configure var
     * @param string $var
     * @return string||bool
     */
    public static function verifyVar($var): ?string
    {
        if (isset($var)) {
            return trim(htmlspecialchars($var));
        }
        return null;
    }
}
