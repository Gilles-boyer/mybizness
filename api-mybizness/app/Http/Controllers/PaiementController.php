<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\PaiementMethod;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;

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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $validated = (object)$request->validated();
        $payment = new PaiementMethod();
        try {
            $newPayment = $this->defineParamsPayment($validated,$payment);
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de création");
        }
        return Utility::responseValid("paiement créé",$newPayment, 201);
    }

    public function defineParamsPayment($params, $payment)
    {
        $payment->paiement_name         = $params->name;
        $payment->paiement_description  = $params->description;
        $payment->save();

        return  new PaymentResource($payment);
    }

            /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaiementMethod $payment
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, PaiementMethod $payment)
    {
        $validated = (object)$request->validated();
        try{
            $this->defineParamsPayment($validated, $payment);
        }catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de modification");
        }
        return Utility::responseValid("payment modifiée");
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaiementMethod   $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaiementMethod $payment)
    {
        try {
            $payment->delete();
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de suppression");
        }
        return Utility::responseValid("categorie supprimée");
    }
}
