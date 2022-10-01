<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Script;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\ScriptRequest;
use App\Http\Requests\ProcessRequest;
use App\Http\Resources\ScriptResource;

class ScriptController extends Controller
{
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

    public function show(int $id)
    {
        return Script::find($id);
    }

    public function destroy(DeleteRequest $request)
    {
        try {
            $script = Script::find($request->id);
            $script->forceDelete();
            return Utility::responseValid("Script éffacé");
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "Problème de suppression, merci de réessayer");
        }
    }

    public function loadScript(ProcessRequest $request)
    {
        $results = [];
        $script = $this->show($request->id);
        foreach ($script->methods as $method) {
            try {
                $results = call_user_func_array(
                    array(Action::loadClass($method->id), $method->method),
                    array($request, $results)
                );
            } catch (Exception $e) {
                return Utility::responseError($e->getMessage());
            }
        }
        return $results;
    }
}
