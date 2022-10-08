<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryModelResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function indexOnline()
    {
        return CategoryModelResource::collection(Category::whereRelation('productsOnline', 'product_online', 1)->get());
    }
}
