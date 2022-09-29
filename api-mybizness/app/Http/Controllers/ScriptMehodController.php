<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ScriptMehod;
use App\Http\Requests\ArrayRequest;
use App\Http\Resources\ScriptMethResource;
use Illuminate\Support\Facades\Validator;

class ScriptMehodController extends Controller
{
    protected $rules = [
        "method_id"   => "required|exists:App\Models\Method,id",
        "script_id"   => "required|exists:App\Models\Script,id",
    ];
    protected $subRules = [
        "method_id"   => "required|exists:App\Models\Method,id",
        "script_method_id"   => "required|exists:App\Models\ScriptMehod,id",
    ];

    /**
     * return specific collection ScriptMethod by scrip_id
     *
     * @param int $scriptId
     * @return App\Http\Requests\ScriptMehodRequest
     */
    public function show(int $scriptId)
    {
        $scriptMethods = ScriptMehod::where('fk_script_id', $scriptId)->get();
        $collection = ScriptMethResource::collection($scriptMethods);
        $sorted = $collection->sortBy("order");
        return $sorted->values()->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ArrayRequest $request
     * @return \Illuminate\Http\Response
     */
    public function processingScriptMethod(ArrayRequest $request)
    {
        foreach ($request->script_methods as $order => $scrip_method) {
            $data = json_decode($scrip_method);
            $validator = Validator::make(
                (array)$data,
                $this->rules,
                Utility::$errors
            );
            if ($validator->fails()) {
                return Utility::responseError(
                    $validator->errors(),
                    "echec validation request"
                );
            }
            try {
                $this->updateOrCreateScriptMethods($data, $order);
            } catch (Exception $e) {
                return Utility::responseError(
                    $e->getMessage(),
                    "echec validation creation"
                );
            }
        }
        return Utility::responseValid("mis à jour effectuée", $this->show($data->script_id));
    }

    /**
     * check if will update or create ScriptMethod
     *
     * @param object $data
     * @param int $order
     * @return void
     */
    public function updateOrCreateScriptMethods(object $data, int $order): void
    {
        if (isset($data->id)) {
            $this->updateOrder($data, $order);
        } else {
            $this->store($data, $order);
        }
    }

    /**
     * update field order for specific ScriptMethod
     *
     * @param object $data
     * @param int $order
     * @return void
     */
    public function updateOrder(object $data, int $order): void
    {
        $scriptMehod = ScriptMehod::find($data->id);
        $scriptMehod->order = $order;
        $scriptMehod->fk_script_mehods_id = null;
        if (count($data->list_method) > 0) {
            foreach ($data->list_method as $key => $value) {
                $this->updateOrCreateSubScriptMethods($value, $key);
            }
        }
        $scriptMehod->save();
    }

    public function processingSubScriptMethod(ArrayRequest $request, $id)
    {
        foreach ($request->script_methods as $order => $scrip_method) {
            $data = json_decode($scrip_method);
            $validator = Validator::make(
                (array)$data,
                $this->subRules,
                Utility::$errors
            );
            if ($validator->fails()) {
                return Utility::responseError(
                    $validator->errors(),
                    "echec validation request"
                );
            }
            try {
                $this->updateOrCreateSubScriptMethods($data, $order);
            } catch (Exception $e) {
                return Utility::responseError(
                    $e->getMessage(),
                    "echec validation store"
                );
            }
        }

        return $this->show((int)$id);
    }

    /**
     * check if will update or create ScriptMethod
     *
     * @param object $data
     * @param int $order
     * @return void
     */
    public function updateOrCreateSubScriptMethods(object $data, int $order): void
    {
        if (isset($data->id)) {
            $this->subUpdate($data, $order);
        } else {
            $this->subStore($data, $order);
        }
    }

    public function subStore($data, $order)
    {
        $scriptMehod = new ScriptMehod();

        $scriptMehod->fk_method_id = $data->method_id;
        $scriptMehod->fk_script_mehods_id = $data->script_method_id;
        $scriptMehod->order = $order;

        $scriptMehod->save();
    }

    public function subUpdate($data, $order)
    {
        $scriptMehod = ScriptMehod::find($data->id);

        $scriptMehod->fk_script_mehods_id = $data->script_method_id;
        $scriptMehod->fk_script_id = null;
        $scriptMehod->order = $order;

        foreach ($data->list_method as $key => $value) {
            $this->updateOrCreateSubScriptMethods($value, $key);
        }

        $scriptMehod->save();
    }

    /**
     * store new ScriptMethod in bdd
     *
     * @param object $data
     * @param int $order
     * @return void
     */
    public function store(object $data, int $order): void
    {
        $scriptMehod = new ScriptMehod();

        $scriptMehod->fk_method_id = $data->method_id;
        $scriptMehod->fk_script_id = $data->script_id;
        $scriptMehod->order = $order;

        $scriptMehod->save();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $validator = Validator::make(
            [
                'id' => $id,
            ],
            [
                'id' => "required|exists:App\Models\ScriptMehod,id",
            ],
            Utility::$errors
        );
        if ($validator->fails()) {
            return Utility::responseError(
                $validator->errors(),
                "echec validation"
            );
        }

        $scriptMehod = ScriptMehod::find($id);

        if ($scriptMehod->forceDelete()) {
            return Utility::responseValid("method effacée");
        }
    }
}
