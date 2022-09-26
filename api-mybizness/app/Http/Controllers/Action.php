<?php

namespace App\Http\Controllers;

use App\Models\Method;

class Action extends Controller
{
    protected static array $objects;
    protected static $action = null;

    /**
     * load controller object
     * @param int $method_id
     * @return object Class Controller
     */
    public static function loadClass(int $method_id)
    {
        $method = Method::find($method_id);

        if(isset(self::$objects[$method->class->class_patch]))
        {
            return self::$objects[$method->class->class_patch];
        }

        self::setAction();
        return self::$action->setObject($method->class->class_patch);
    }

    public static function setAction()
    {
        if(self::$action == null){
            self::$action = new Action();
        }
    }

    public function setObject($className)
    {
        $object = __NAMESPACE__."\\".$className;
        self::$objects[$className] = new $object();
        return self::$objects[$className];
    }
}
