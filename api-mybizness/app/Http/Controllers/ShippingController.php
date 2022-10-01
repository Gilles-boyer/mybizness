<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ShippingMethod;

/**
 * Observable : true
 * Name : Shipping
 * Description : list methods shipping controller
 */
class ShippingController extends Controller
{
    public function validatedShippingId($validator)
    {
        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }
        return $validator->validated();
    }

    /**
     * Observable : true
     * Name : load shipping
     * Description : load shipping object by id
     */
    public function loadShippingMethod($request, $results)
    {
        $shipping = json_decode($request->shipping);

        $results['shipping'] = $this->show(
            $this->validatedShippingId($this->validateId(['id' => $shipping->id], "ShippingMethod"))
        );
        return $results;
    }

    public function show($id)
    {
        return ShippingMethod::find($id)->first();
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
}
