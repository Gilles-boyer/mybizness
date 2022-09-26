<?php

namespace App\Http\Utilities;

use App\Http\Controllers\ClassNameController;
use App\Http\Controllers\MethodController;
use ReflectionClass;

class CommentUtility
{
    private static array $objects;

    /**
     * verify class exist and if don't exist add new class to $objects
     *
     * @param string $class
     * @return object
     */
    private static function getObject(string $class): object
    {
        if (!isset($objects[$class])) {
            self::setObjects($class);
        }
        return self::$objects[$class];
    }

    /**
     * set attribute $object with new class
     *
     * @param string $class
     * @return object
     */
    private static function setObjects(string $class): void
    {
        self::$objects[$class] = new ReflectionClass($class);
    }

    /**
     * check comment to code php of method, read, process, and return if method is Observable
     *
     * @param string $className
     * @param string $methodName
     * @param int    $class_id
     * @return object||null
     */
    public static function isObservableMethod(string $className, string $methodName, int $class_id):?array
    {
        $ref = self::getObject($className);
        $comment = $ref->getMethod($methodName)->getDocComment();
        $comment = self::commentToArray($comment);

        if ($comment) {
            if ($comment["Observable"] == "true") {
                return $comment;
            } elseif ($comment["Observable"] == "false") {
                MethodController::delete($methodName, $class_id);
            }
        }
        return null;
    }

    /**
     * check comment to code php of class, read, process, and return if class is Observable
     *
     * @param string $class
     * @return object||bool
     */
    public static function isObservableClass(string $class):?string
    {
        $comment = self::commentToArray(self::classComment($class));

        if ($comment) {
            if ($comment["Observable"] == "true") {
                return $comment["Observable"];
            } elseif ($comment["Observable"] == "false") {
                ClassNameController::delete($class);
            }
        }
        return null;
    }

    /**
     * check comment to code php of class and return comment class
     *
     * @param string $className
     * @return string||null
     */
    public static function classComment(string $className):?string
    {
        $ref = self::getObject($className);
        return $ref->getDocComment();
    }

    /**
     * check if comment contain element necessary and if contain return tab of comment
     *
     * @param  string $comment
     * @return array||null
     */
    public static function commentToArray(string $comment):?array
    {
        $comment = str_replace('*', '', $comment);
        $comment = str_replace('/', '', $comment);

        if (!(str_contains($comment, "Name :"))) {
            return null;
        }

        $comment = explode("\n", $comment);
        $tab = [];
        foreach ($comment as $i => $com) {
            if (!(str_contains($com, "@"))) {
                if (trim($com)) {
                    $sub = explode(":", trim($com));
                    $tab[trim($sub[0])] = trim($sub[1]);
                }
            }
        }
        return $tab;
    }
}
