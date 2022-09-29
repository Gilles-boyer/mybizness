<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Calculate total product buy
     * @param array $tab
     * @return int $total
     */
    public static function calculateTotal(array $tab)
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
