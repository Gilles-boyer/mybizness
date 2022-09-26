<?php

namespace App\Http\Controllers;

use App\Http\Utilities\CommentUtility;
use HaydenPierce\ClassFinder\ClassFinder;

class NamespaceUtility
{
    public static function listClassByNamespaceObservable($namespace)
    {
        $listClass = ClassFinder::getClassesInNamespace(__NAMESPACE__);
        $tab = [];
        foreach ($listClass as $key => $class) {
            if (CommentUtility::isObservableClass($class)) {
                array_push($tab, str_replace("App\\Http\\Controllers\\", "", $class));
            }
        }

        return $tab;
    }
}
