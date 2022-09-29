<?php

namespace App\Http\Controllers;

use Exception;
use ReflectionClass;
use App\Models\ClassName;
use App\Http\Resources\ClassNameResource;
use App\Http\Controllers\NamespaceUtility;
use App\Http\Requests\StoreClassNameRequest;
use App\Http\Requests\UpdateClassNameRequest;
use App\Http\Utilities\CommentUtility;

class ClassNameController extends Controller
{
    private static $object;


    public function __construct()
    {
        self::$object = $this;
    }

    /**
     * @observable
     *
     * Display a listing of the resource ClassName.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): object
    {
        $listClass = NamespaceUtility::listClassByNamespaceObservable(__NAMESPACE__);
        foreach ($listClass as $class) {
            $comment = CommentUtility::commentToArray(
                CommentUtility::classComment($this->getClassWithNamespace($class))
            );
            $arrayComment = StoreClassNameRequest::create("", 'GET', [
                "name"        => $comment['Name'],
                "description" => $comment['Description'],
                "class_patch" => $class
            ]);
            if (!$this->classExist($class)) {
                $Class = new ClassName();
            } else {
                $Class = $this->show($class);
            }
            $this->configureClassNameForSave($Class, $arrayComment);
        }

        return Utility::responseValid(
            "liste des class",
            ClassNameResource::collection(
                ClassName::all()
            )
        );
    }

    /**
     * Check if class exist in BDD
     *
     * @param  string  $class_patch
     * @return boolean
     */
    public function classExist(string $class_patch): bool
    {
        if ($this->show($class_patch)) {
            return true;
        }
        return false;
    }



    /**
     * configure object class and save
     *
     * @param  \App\Http\Model\ClassName  $class
     * @param  \App\Http\Requests\StoreClassNameRequest $request
     * @return \App\Http\Model\ClassName
     */
    public function configureClassNameForSave(ClassName $class, StoreClassNameRequest $request): object
    {
        $class->name        = ucfirst($request->name);
        $class->description = ucfirst($request->description);
        $class->class_patch = $request->class_patch;
        $class->save();

        return $class;
    }

    /**
     * return specific Class by class_patch
     *
     * @param  string   $class_patch
     * @return \App\Http\Model\ClassName
     */
    public function show(string $class_patch): ?object
    {
        return  ClassName::where("class_patch", $class_patch)->first();
    }



    /**
     * configure object class and save
     *
     * @param  string   $class_patch
     * @return void
     */
    public static function delete(string $class_patch): void
    {
        $class = str_replace(__NAMESPACE__ . "\\", "", $class_patch);
        $className = self::$object->show($class);
        $className->forceDelete();
    }
}
