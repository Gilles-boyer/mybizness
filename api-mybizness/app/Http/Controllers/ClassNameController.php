<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ClassName;
use App\Http\Resources\ClassNameResource;
use HaydenPierce\ClassFinder\ClassFinder;

class ClassNameController extends Controller
{
    /**
     * Display a listing of the resource ClassName.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            foreach ($this->loadClassInNameSpace() as $class) {
                $comment = $this->loadObservableClass($class);
                if ($comment) {
                    $comments = $this->adapterClassName($comment['Name'], $comment['Description'], $class);
                    $this->updateListClass($class, $comments);
                }
            }
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage());
        }
        return Utility::responseValid(
            "liste des class",
            ClassNameResource::collection(
                ClassName::all()
            )
        );
    }

    /**
     * get all classes in namespace
     * @return ClassFinder
     */
    public function loadClassInNameSpace()
    {
        return ClassFinder::getClassesInNamespace(__NAMESPACE__);
    }

    /**
     * get Observable class
     * @param string $class
     * @return comment
     */
    public function loadObservableClass(string $class)
    {
        $comment = CommentController::getObservableClasses($class);
        if (!$comment || $comment['Observable'] == "false") {
            if ($this->classExist($class)) {
                $this->show($class)->forceDelete();
            }
            return null;
        }
        return $comment;
    }

    /**
     * update list Class
     * @param string $class
     * @param object $comments
     * @return void;
     */
    public function updateListClass(string $class, $comments)
    {
        if (!$this->classExist($class)) {
            $Class = new ClassName();
        } else {
            $Class = $this->show($class);
        }
        $this->configureClassNameForSave($Class, $comments);
    }

    /**
     * adapt data for create new  StoreClassNameRequest
     * @param string $name
     * @param string $description
     * @param string $class
     * @return StoreClassNameRequesté
     */
    public function adapterClassName(string $name, string $description, string $class)
    {
        return [
            "name"        => ucfirst($name),
            "description" => ucfirst($description),
            "class_patch" => $class
        ];
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
     * @param   $class
     * @param   $comment
     * @return \App\Http\Model\ClassName
     */
    public function configureClassNameForSave($class, $comment)
    {
        $class->name        = $comment['name'];
        $class->description = $comment['description'];
        $class->class_patch = $comment['class_patch'];
        $class->save();
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
}
