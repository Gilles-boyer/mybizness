<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CategoryModelResource;

class CategoryController extends Controller
{
    public function indexOnline()
    {
        return CategoryModelResource::collection(Category::whereRelation('productsOnline', 'product_online', 1)->get());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoriesResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $validated = (object)$request->validated();
        $category = new Category();
        try {
            $newCategory = $this->defineParamsCategory($validated,$category);
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de création");
        }
        return Utility::responseValid("category créé",$newCategory, 201);
    }

    public function defineParamsCategory($params, $category)
    {
        $category->category_name  = $params->name;
        $category->category_description = $params->description;
        $category->category_icon = $params->icon;
        $category->save();

        return  new CategoriesResource($category);
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $validated = (object)$request->validated();
        try{
            $this->defineParamsCategory($validated, $category);
        }catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de modification");
        }
        return Utility::responseValid("category modifiée");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de suppression");
        }
        return Utility::responseValid("categorie supprimée");
    }

}

