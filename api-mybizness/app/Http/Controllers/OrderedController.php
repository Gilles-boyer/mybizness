<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderedController extends Controller
{
    public function processingOrdered(
        Request $request
    )
    {
        $beneficiary = $request->beneficiary;
        return $request;
    }
}
