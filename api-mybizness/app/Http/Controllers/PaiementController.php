<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
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
     * Name : find payment
     * Description : find method payment object by id
     */
    public function loadPaymentMethodById($request, $results)
    {
        $results['paiement'] = $this->show((int)$request->payment);
        return $results;
    }

    public function show($id)
    {
        return PaiementMethod::find($id);
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

    public function index()
    {
        return PaymentResource::collection(PaiementMethod::all());
    }
}
