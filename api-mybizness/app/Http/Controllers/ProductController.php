<?php

namespace App\Http\Controllers;

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
}
