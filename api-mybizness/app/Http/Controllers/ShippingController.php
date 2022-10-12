<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ShippingOnlineResource;
use App\Http\Resources\ShippingResource;
use App\Http\Resources\VoucherResource;
use Exception;
use App\Models\ShippingMethod;

/**
 * Observable : true
 * Name : Shipping
 * Description : list methods shipping controller
 */
class ShippingController extends Controller
{

    public function indexOnline()
    {
        return ShippingOnlineResource::collection(ShippingMethod::where("shipping_online", true)->get());
    }

    /**
     * Observable : true
     * Name : load shipping
     * Description : load shipping object by id
     */
    public function loadShippingMethod($request, $results)
    {
        $results['shipping'] = $this->show($request->shipping);
        return $results;
    }

    public function show($id)
    {
        return ShippingMethod::find($id);
    }

    /**
     * Observable : true
     * Name : script Shipping
     * Description : load script Shipping
     */
    public function loadScriptShipping($request, $results)
    {
        $method = $results['shipping']->method;
        return call_user_func_array(
            array(Action::loadClass($method->id), $method->method),
            array($request, $results)
        );
    }

    /**
     * Observable : true
     * Name : send take on place
     * Description : return response
     */
    public function takeOnPlace($request, $results)
    {
        return  Utility::responseValid("commande traité", new OrderResource($results['order']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ShippingResource::collection(ShippingMethod::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingRequest $request)
    {
        $validated = (object)$request->validated();
        $shipping = new ShippingMethod();
        try {
            $newShipping = $this->defineParamsShipping($validated, $shipping);
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de création");
        }
        return Utility::responseValid("shipping créé", $newShipping, 201);
    }

    public function defineParamsShipping($params, $shipping)
    {
        $shipping->shipping_name        = $params->name;
        $shipping->shipping_description = $params->description;
        $shipping->fk_method_id         = $params->method_id;
        $shipping->save();

        return  new ShippingResource($shipping);
    }

    public function updateOnline(ShippingMethod $shipping)
    {
        try {
            $shipping->shipping_online =  !$shipping->online;
            $shipping->save();
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur modification methode d'envoi online");
        }
        return Utility::responseValid("online methode d'envoi modifiée");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingRequest $request, ShippingMethod $shipping)
    {
        $validated = (object)$request->validated();
        try {
            $this->defineParamsShipping($validated, $shipping);
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de modification");
        }
        return Utility::responseValid("methode d'envoi modifiée");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingMethod $shipping)
    {
        try {
            $shipping->delete();
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de suppression");
        }
        return Utility::responseValid("methode d'envoi supprimée");
    }
}
