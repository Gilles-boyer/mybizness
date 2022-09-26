<?php

namespace App\Http\Controllers;

use Exception;
use Ramsey\Uuid\Uuid;
use App\Models\Script;
use App\Models\Voucher;
use App\Models\ScriptMehod;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Validator;

/**
 * Observable : true
 * Name : Processing Order
 * Description : All methods for order gift voucher
 */
class ProcessingController extends Controller
{
    protected array $objects;
    protected $scriptMethod;

    protected array $rulesPerso = [
        "theme_id" => "required|exists:App\Models\Theme,id",
        "backgroundColor" => "required|string",
        "fontFamily" => "required|string",
        "message" => "required|string",
        "shipping_id" => "required|exists:App\Models\ShippingMethod,id",
    ];

    public function __construct()
    {
        $this->scriptMethod = new ScriptMehodController();
        $this->app = new ApplicationController();
    }

    public function index($id, $any)
    {
        $next = [
            "script_id" => $id,
            "url"       => $any
        ];
        $validator = (array)$this->validateScript($next);
        if (isset($validator["success"])) {
            return $validator;
        }
        return $this->script($validator);
    }

    protected function callback($method, ...$params)
    {
        return call_user_func_array(array($this, $method), $params);
    }

    protected function error($message)
    {
        return Utility::responseError([], $message);
    }

    protected function script($next)
    {
        try {
            $next['script'] = $this->parseArray(
                (array)$this->scriptMethod->show((int)$next['script_id'])
            );
            $next['params'] = $this->processingUrl($next['url']);
            return $this->callback($next['script'][0]->method, $next);
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    protected function validateScript($next)
    {
        $validator = Validator::make(
            $next,
            [
                'script_id' => "required|exists:App\Models\Script,id",
                "url"       => "required|string"
            ],
            Utility::$errors
        );
        if ($validator->fails()) {
            return Utility::responseError(
                $validator->errors(),
                "echec validation"
            );
        }
        return $validator->validated();
    }

    protected function parseArray(array $array): array
    {
        foreach ($array as $i => $element) {
            $array[$i] = $this->parseObject($element);
        }

        return $array;
    }

    /**
     * fix object resources
     * @param object $object
     * @return object
     */
    protected function parseObject(object $object): object
    {
        $object = json_encode($object);
        return json_decode($object);
    }

    /**
     * Observable : true
     * Name : isOnline Order
     * Description : check if url contain online
     */
    public function isOnline($params)
    {
        if (str_contains($params['url'], "online")) {
            $params['script'] = $params['script'][0]->list_method;
            if (count($params['script']) > 0) {
                return $this->callback($params['script'][0]->method, $params);
            }
            return Utility::responseValid("l'url contient online");
        }
        return $this->nextStep($params);
    }

    public function nextStep($params)
    {
        if (count($params['script']) > 1) {
            $params['script'] = array_slice($params['script'], 1);
            return $this->callback($params['script'][0]->method, $params);
        }
        return Utility::responseValid("Script response", $params);
    }

    /**
     * Observable : true
     * Name : isOffice Order
     * Description : check if url contain office
     */
    public function isOffice($params)
    {
        if (str_contains($params['url'], "office")) {
            $params['script'] = $params['script'][0]->list_method;
            if (count($params['script']) > 0) {
                return $this->callback($params['script'][0]->method, $params);
            }
            return Utility::responseValid("l'url contient office");
        }
        return $this->nextStep($params);
    }

    /**
     * Observable : true
     * Name : stripe paiement
     * Description : define stripe for paiement
     */
    public function setStripePaiement($params)
    {
        $params["paiement"] = PaiementController::getPaiement("stripe");

        return $this->nextStep($params);
    }

    /**
     * Observable : true
     * Name : Custumer
     * Description : define custumer
     */
    public function defineCustumer($params)
    {
        if (isset($params["params"]["custumer"])) {
            $user = UserController::getCustumer((array)json_decode($params["params"]["custumer"]));
            if (isset($user["success"])) {
                return $user;
            }
            $params["custumer"] = $user;
            return $this->nextStep($params);
        }
        return $this->error("custumer non définie");
    }


    /**
     * Observable : true
     * Name : Beneficiary
     * Description : define Beneficiary
     */
    public function defineBeneficiary($params)
    {
        if (isset($params["params"]["beneficiary"])) {
            $user = UserController::getCustumer((array)json_decode($params["params"]["beneficiary"]));
            if (isset($user["success"])) {
                return $user;
            }
            $params["beneficiary"] = $user;
            return $this->nextStep($params);
        }
        return $this->error("beneficiary non définie");
    }

    /**
     * Observable : true
     * Name : create order
     * Description : process create order
     */
    public function createOrder($params)
    {
        $total = ProductController::calculateTotal(json_decode($params["params"]["list_gifts"]));
        if ($total != (int)$params["params"]["price"]) {
            return Utility::responseError([], "erreur de tarif");
        }
        try {
            $params['order'] = OrderedController::createOrder(
                $total,
                $params['custumer']['id'],
                $params['beneficiary']['id'],
                $params['paiement']['id'],
                $params['app']['id']
            );
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur order");
        }

        return $this->addProductOrder($params);
    }

    public function addProductOrder($params)
    {
        try {
            OrderedController::createProductOrder(
                json_decode($params["params"]["list_gifts"]),
                $params['order']['id']
            );
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur add product order");
        }
        return $this->nextStep($params);
    }

    /**
     * Observable : true
     * Name : create voucher
     * Description : create in bdd a new voucher
     */
    public function createVoucher($params)
    {
        return $this->validateTheme($params);
    }

    public function validateTheme($params)
    {
        $validator = Validator::make(
            $this->configValidationVoucher($params),
            $this->rulesPerso,
            Utility::$errors
        );
        if ($validator->fails()) {
            return Utility::responseError(
                $validator->errors(),
                "echec validation"
            );
        }
        $params['voucher'] = $validator->validated();

        return $this->addNewVoucher($params);
    }

    public function configValidationVoucher($params)
    {
        $params["params"]["personalization"]=(array)json_decode($params["params"]["personalization"]);
        $params["params"]["shipping_method"]=(array)json_decode($params["params"]["shipping_method"]);

        return [
            "theme_id" => $params["params"]['personalization']['theme'],
            "backgroundColor" => $params["params"]['personalization']['backgroundColor'],
            "fontFamily" => $params["params"]['personalization']['fontFamily'],
            "message" => $params["params"]['personalization']["message"],
            "shipping_id" => $params["params"]['shipping_method']['id'],
        ];
    }

    public function addNewVoucher($params) {
        $voucher = new Voucher();
        $voucher->voucher_num = (string)Uuid::uuid4();
        $voucher->voucher_validity =  date("Y-m-d", strtotime(now(). ' + 100 days'));
        $voucher->voucher_message = $params["voucher"]["message"];
        $voucher->voucher_color = $params["voucher"]["backgroundColor"];
        $voucher->voucher_font = $params["voucher"]["fontFamily"];
        $voucher->fk_order_id = $params["order"]["id"];
        $voucher->fk_theme_id = $params["voucher"]["theme_id"];
        $voucher->fk_shipping_id = $params["voucher"]["shipping_id"];

        $voucher->save();

        return $voucher;
    }

    /**
     * Observable : true
     * Name : check token url
     * Description : verify token  in url
     */
    public function verifyTokenAppInUrl($params)
    {
        if (isset($params['params']['token'])) {
            $app = ApplicationController::verifToken($params['params']['token']);
            if (isset($app->success)) {
                return $app;
            }
            $params['app'] = $app;
        }
        return $this->nextStep($params);
    }

    public function processingUrl(string $url)
    {
        $tabs = explode("/", $url);

        foreach ($tabs as $i => $tab) {
            if (str_contains($tab, "=")) {
                $tabs[$i] = explode("=", $tab);
            }
        }
        foreach ($tabs as $i => $tab) {
            if (is_array($tab)) {
                $tabs[$tab[0]] = $tab[1];
            }
        }
        return $tabs;
    }
}
