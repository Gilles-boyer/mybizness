<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public static function calculateTotal($tab)
    {
        $total = 0;
        foreach ($tab as $id)
        {
            $product = Product::find($id);
            $total += $product->product_price;
        }
        return $total;
    }
}
