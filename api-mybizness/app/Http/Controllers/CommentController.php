<?php

namespace App\Http\Controllers;

use ReflectionClass;

class CommentController extends Controller
{
    public static array $reflectionClasses;

    /**
     * get specific refelction class
     * @param string $class
     * @return self::$reflectionClasses
     */
    public static function getReflectionClasses($class)
    {
        if (!isset($reflectionClasses[$class])) {
            self::setReflectionClasses($class);
        }
        return self::$reflectionClasses[$class];
    }

    /**
     * set $reflectionclasses
     * @param string $class
     * @return void
     */
    public static function setReflectionClasses($class)
    {
        self::$reflectionClasses[$class] = new ReflectionClass($class);
    }

    /**
     * get comment class
     * @param string $class
     * @return function getCommentClass
     */
    public static function getObservableClasses($class)
    {
        return self::getCommentClass($class);
    }

    /**
     * configure get comment class
     * @param string $class
     * @return function converterDataCommentToArray
     */
    public static function getCommentClass($class)
    {
        $ref = self::getReflectionClasses($class);
        return self::converterDataCommentToArray($ref->getDocComment());
    }

    /**
     * get observalble method
     * @param string $class
     * @param string $method
     * @return function converterDataCommentToArray
     */
    public static function getObservableMethod($class, $method)
    {
        $ref = self::getReflectionClasses($class);
        return self::converterDataCommentToArray($ref->getMethod($method)->getDocComment());
    }

    /**
     * configure data comment for process
     * @param string $comment
     * @return array
     */
    public static function converterDataCommentToArray($comment)
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
