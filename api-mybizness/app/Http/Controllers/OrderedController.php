<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\ProductOrder;

/**
 * Observable : true
 * Name : Order
 * Description : list function for order controller
 */
class OrderedController extends Controller
{
    /**
     * Observable : true
     * Name : create order online
     * Description : create a new order online
     */
    public function createOrderOnline($request, $results)
    {
        $results['order'] = $this->storeOrder($this->adapterOrderOnline($results));
        $this->createProductOrders($results);
        return $results;
    }

    public function createProductOrders($results)
    {
        foreach($results['gifts'] as $gift)
        {
            $this->storeProductOrder(
                $this->adapterProductOrder($gift->id, $results['order']->id)
            );
        }
    }

    public function adapterOrderOnline($results)
    {
        return [
            "order_total"       => $results['total'],
            "fk_client_id"      => $results['customer']->id,
            "fk_beneficiary_id" => $results['beneficiary']->id,
            "fk_paiement_id"    => $results['paiement']->id,
            "fk_app_id"         => $results['app']->id
        ];
    }

    public function adapterProductOrder($productId, $orderId)
    {
        return [
            "fk_product_id" => $productId,
            "fk_order_id"   => $orderId
        ];
    }

    public function storeOrder($adapter)
    {
        return Order::create($adapter);
    }

    public function storeProductOrder($adapter)
    {
        ProductOrder::create($adapter);
    }

    public function index()
    {
        return OrderResource::collection(Order::all());
    }
}
