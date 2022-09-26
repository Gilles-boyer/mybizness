<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteRequest;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\ScriptRequest;
use App\Http\Requests\UserClientRequest;
use App\Http\Requests\OrderScriptRequest;
use App\Http\Resources\ScriptResource;
use App\Models\Script;

/**
 * Observable : true
 * Name : Script
 * Description : liste des scripts
 */
class ScriptController extends Controller
{

    /**
     * Observable : true
     * Name : script voucher online
     * Description: lance le script de la vente en ligne pour les bons kdo
     */
    public function processingScriptVoucherOnline()
    {

    }

    /**
     * list all Script
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Utility::responseValid(
            "list scripts",
            ScriptResource::collection(Script::all())
        );
    }

    /**
     * store new Script in Bdd
     *
     * @param App\Http\Requests\ScriptRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScriptRequest $request): object
    {
        $script = new Script();

        $script->name = $request->name;
        $script->description = $request->description;

        if ($script->save()) {
            return Utility::responseValid("Script créé", new ScriptResource($script));
        } else {
            return Utility::responseError([], "Problème de création, merci de réessayer");
        }
    }

    public function destroy(DeleteRequest $request)
    {
        $script = Script::find($request->id);

        if ($script->forceDelete()) {
            return Utility::responseValid("Script éffacé");
        } else {
            return Utility::responseError([], "Problème de suppression, merci de réessayer");
        }
    }

    public function buyVoucher(OrderScriptRequest $request)
    {
        return array("test", "t1");
        if ($request->location == "online") {
            return $this->buyOnline($request);
        };

        return Utility::responseError(
            "une erreur s'est produite dans le choix si achat en ligne ou sur place"
        );
    }

    public function buyOnline(OrderScriptRequest $request)
    {
        $step =  [
            "adapter la request à request user",
            "stoker le client",
            "récupérer l'objet app",
            "récuper l'objet paiement stripe",
            "récupérer un tableau objet produit",
            "vérifier que le montant des produits correspond au total",
            "créer une commande",
            "associer la commande des produits",
            "envoyer un mail pour confirmer la commande",
            "récupérer l'objet theme",
            "récuperer l'objet livraison",
            "adapter element pour voucher",
            "créer voucher",
            "générer le ou les voucher",
            "livrer le bon"
        ];


        $beneficiary = json_decode($request->beneficiary);
        if (isset($beneficiary->isForHim)) {
            if ($beneficiary->isForHim) {
                return $this->customerBuyForHimOnline($request);
            } else {
                return $this->customerBuyForBeneficiaryOnline($request, $beneficiary);
            }
        }

        return Utility::responseError(
            "une erreur s'est produite dans le choix d'achat du client en ligne pour lui ou un bénéficiaire"
        );
    }

    public function customerBuyForHimOnline(OrderScriptRequest $request)
    {

        return $this->processingAdapterClient($request, "processingStoreClient");
    }

    public function customerBuyForBeneficiaryOnline(OrderScriptRequest $request, $beneficiary)
    {
    }


    private function processingAdapterClient(OrderScriptRequest $request, callable $next = null)
    {
        try {
            $request->client = RequestAdapter::userRequest(
                $request->client_fisrtname,
                $request->client_lastname,
                $request->client_phone,
                $request->client_email
            );
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "probleme d'adaptateur user client");
        }

        if ($next) {
            return call_user_func_array(array($this, $next), array($request, ""));
        } else {
            return $request->client;
        }
    }

    private function processingStoreClient(UserClientRequest $request)
    {
        return  $this->user->store($request, "client", false);
    }


    private function processingAdapterBeneficiary(OrderScriptRequest $request)
    {
        $objectBeneficiary = json_decode($request->beneficiary);
        return  RequestAdapter::userRequest(
            $objectBeneficiary->firstName,
            $objectBeneficiary->lastName,
            $objectBeneficiary->tel,
            $objectBeneficiary->email,
        );
    }
}
