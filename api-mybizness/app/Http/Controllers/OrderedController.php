<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Models\ProductOrder;
use App\Http\Controllers\RequestAdapter;
use App\Http\Controllers\UserController;
use App\Http\Requests\UserClientRequest;
use App\Http\Requests\StoreOrderedRequest;


class OrderedController extends Controller
{
    private UserController $user;

    public function __construct()
    {
        $this->user = new UserController();
    }

    public static function createOrder(
        $order_total,
        $fk_client_id,
        $fk_beneficiary_id,
        $fk_paiement_id,
        $fk_app_id
    ) {
        $order = new Order();
        $order->order_total = $order_total;
        $order->fk_client_id = $fk_client_id;
        $order->fk_beneficiary_id = $fk_beneficiary_id;
        $order->fk_paiement_id = $fk_paiement_id;
        $order->fk_app_id = $fk_app_id;

        $order->save();

        return $order;
    }

    public static function createProductOrder($tab, $order_id)
    {
        foreach ($tab as $id) {
            $productOrder = new ProductOrder();
            $productOrder->fk_product_id = $id;
            $productOrder->fk_order_id = $order_id;;
            $productOrder->save();
        }
    }

    public function processingOrdered(StoreOrderedRequest $request)
    {
        try {
            $requestClient = $this->processingAdapterClient($request);
            $client = $this->processingClient($requestClient);
        } catch (Exception $e) {
            return  Utility::responseError($e->getMessage(), "Traitement client impossible");
        }

        try {
            $requestBeneficiary = $this->processingAdapterBeneficiary($request);
            $beneficiary = $this->processingBeneficiary($requestBeneficiary);
        } catch (Exception $e) {
            return  Utility::responseError($e->getMessage(), "Traitement bénéficiaire impossible");
        }

        return [
            "client" => $client,
            "beneficiary" => $beneficiary
        ];
    }

    private function processingAdapterClient(StoreOrderedRequest $request)
    {
        return  RequestAdapter::userRequest(
            $request->client_fisrtname,
            $request->client_lastname,
            $request->client_phone,
            $request->client_email
        );
    }

    private function processingClient(UserClientRequest $request)
    {
        return  $this->user->store($request, "client", false);
    }

    private function processingAdapterBeneficiary(StoreOrderedRequest $request)
    {
        $objectBeneficiary = json_decode($request->beneficiary);
        return  RequestAdapter::userRequest(
            $objectBeneficiary->firstName,
            $objectBeneficiary->lastName,
            $objectBeneficiary->tel,
            $objectBeneficiary->email,
        );
    }

    private function processingBeneficiary(UserClientRequest $request)
    {
        return $this->user->store($request, "beneficiary", false);
    }
}
