<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use Exception;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProcductModelResource;

/**
 * Observable : true
 * Name : Product
 * Description : list method for productController
 */
class ProductController extends Controller
{
    public function indexOnline() {
        return  ProcductModelResource::collection(Product::where("product_online", true)->get());
    }
    public function validatedIdProduct($validator)
    {
        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }
        return $validator->validated();
    }
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Observable : true
     * Name : loadProducts
     * Description : list product in basket
     */
    public function loadProducts($request, $results)
    {
        $results['gifts'] = [];
        $results['total'] = 0;
        if(gettype($request->gifts) === "string"){
            $request->gifts = json_decode($request->gifts);
        }
        foreach ($request->gifts as $giftId) {
            $validate = $this->validatedIdProduct($this->validateId(['id' => (int)$giftId], "Product"));
            $product = $this->show($validate['id']);
            $results['total'] += $product->product_price;
            array_push($results['gifts'], $product);
        }
        return $results;
    }

    /**
     * Observable : true
     * Name : validate total
     * Description : validate total product in basket
     */
    public function validateTotal($request, $results)
    {
        if (!((int)$request->total == $results['total'])) {
            throw new Exception("différence de tarif entre produit et monant payé");
        }
        return $results;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProcductModelResource::collection(Product::all());
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $validated = (object)$request->validated();
        $product = new Product();

        try {
            $newProduct = $this->defineParamsProduct($validated, $product);
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de création");
        }
        return Utility::responseValid("product créé",$newProduct, 201);
    }

    public function defineParamsProduct($params, $product)
    {
        $product->product_name          = $params->name;
        $product->product_description   = $params->description;
        $product->product_img           = $params->img;
        $product->product_price         = $params->price;
        $product->fk_category_id        = $params->category_id;
        $product->save();

        return  new ProcductModelResource($product);
    }

    public function updateOnline(Product $product)
    {
        try{
            $product->product_online =  !$product->online;
            $product->save();
        }catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur modification produit online");
        }
        return Utility::responseValid("online produit modifiée");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStoreRequest $request, Product $product)
    {
        $validated = (object)$request->validated();
        try{
            $this->defineParamsProduct($validated, $product);
        }catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de modification");
        }
        return Utility::responseValid("produit modifiée");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de suppression");
        }
        return Utility::responseValid("produit supprimée");
    }
}
