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
        $this->adapterOrderOnline($results);
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
        $base = [
            "order_total"       => $results['total'],
            "fk_client_id"      => $results['customer']->id,
            "fk_beneficiary_id" => $results['beneficiary']->id,
            "fk_paiement_id"    => $results['paiement']->id,
        ];

        if(isset($results['app'])) {
          $base = [
                "order_total"       => $results['total'],
                "fk_client_id"      => $results['customer']['id'],
                "fk_beneficiary_id" => $results['beneficiary']['id'],
                "fk_paiement_id"    => $results['paiement']->id,
                "fk_app_id"         => $results['app'][0]->id,
            ];
        } else {
            $base = [
                "order_total"       => $results['total'],
                "fk_client_id"      => $results['customer']->id,
                "fk_beneficiary_id" => $results['beneficiary']->id,
                "fk_paiement_id"    => $results['paiement']->id,
                "fk_staff_id"       => 1 //user auth
            ];
        }

        return $base;
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
        $order = new order();
        $order->order_total =  $adapter['order_total'];
        $order->fk_client_id = $adapter['fk_client_id'];
        $order->fk_beneficiary_id = $adapter['fk_beneficiary_id'];
        $order->fk_paiement_id = $adapter['fk_paiement_id'];
        if(isset($adapter['fk_app_id'])){
            $order->fk_app_id = $adapter['fk_app_id'];
        } else {
            $order->fk_staff_id = 1 ;//user auth
        }
        $order->save();

        return $order;
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
