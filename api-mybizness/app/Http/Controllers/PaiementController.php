<?php

namespace App\Http\Controllers;

use App\Models\PaiementMethod;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public static function getPaiement($name)
    {
        return PaiementMethod::where("paiement_name", $name)->first();
    }
}
