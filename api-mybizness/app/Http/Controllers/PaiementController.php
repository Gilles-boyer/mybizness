<?php

namespace App\Http\Controllers;

use App\Models\PaiementMethod;

/**
 * Observable : true
 * Name : Paiement
 * Description : List method paiement controller
 */
class PaiementController extends Controller
{
    /**
     * get model paiement by name
     * @param string $name
     * @return PaiementMethod
     */
    public function getPaiement(string $name)
    {
        return PaiementMethod::where("paiement_name", $name)->first();
    }

    /**
     * Observable : true
     * Name : Stripe paiement
     * Description : attribute stripe paiement method in order
     */
    public function loadStripePaiement($request, $results)
    {
        $results['paiement'] = $this->getPaiement("stripe");
        return $results;
    }
}
