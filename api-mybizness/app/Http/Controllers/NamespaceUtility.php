<?php

namespace App\Http\Controllers;

use App\Http\Utilities\CommentUtility;
use HaydenPierce\ClassFinder\ClassFinder;

class NamespaceUtility
{
    /**
     * search list class in NameSpace
     * @return array
     */
    public static function listClassByNamespaceObservable()
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
