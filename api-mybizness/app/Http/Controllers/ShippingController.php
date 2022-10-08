<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ShippingOnlineResource;
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
}
