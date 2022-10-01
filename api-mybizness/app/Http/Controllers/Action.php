<?php

namespace App\Http\Controllers;

use App\Models\Method;

class Action extends Controller
{
    public static array $objects;

    /**
     * load controller object
     * @param int $method_id
     * @return object Class Controller
     */
    public static function loadClass(int $method_id)
    {
        $method = Method::find($method_id);

        if (isset(self::$objects[$method->class->class_patch])) {
            return self::$objects[$method->class->class_patch];
        }
        return self::setObject($method->class->class_patch);
    }

    /**
     * create new object
     * @param string $className
     * @return object
     */
    protected static function setObject(string $className)
    {
        self::$objects[$className] = new $className();
        return self::$objects[$className];
    }
}
