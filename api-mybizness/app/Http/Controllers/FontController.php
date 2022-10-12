<?php

namespace App\Http\Controllers;

use App\Http\Requests\FontStoreRequest;
use Exception;
use App\Models\Font;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\FontOnlineResource;
use App\Http\Resources\FontResource;

/**
 * Observable : true
 * Name : font
 * Description : font controller
 */
class FontController extends Controller
{
    static $ruleId = [
        "id" => "required|exists:App\Models\Font,id"
    ];


    /**
     * Observable : true
     * Name : load font
     * Description : load font by id
     */
    public function loadFont($request, $results)
    {
        if (gettype($request->personalization) === "string") {
            $results['font'] = $this->fontOnline($request->personalization);
        } else {
            $results['font'] = $this->show((int)($request->personalization)['font']);
        }
        return $results;
    }

    public function fontOnline($personalization)
    {
        $personalization = json_decode($personalization);
        $validator = Validator::make(
            ['id' => $personalization->font],
            self::$ruleId,
            Utility::$errors
        );
        $x = $this->validatedFontId($validator);
        return  $this->show((int)$x['id']);
    }

    public function validatedFontId($validator)
    {
        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }
        return $validator->validated();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FontResource::collection(Font::all());
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOnline()
    {
        return FontOnlineResource::collection(Font::where("online", true)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FontStoreRequest $request)
    {
        $validated = (object)$request->validated();
        $font = new Font();

        try {
            $newFont = $this->defineParamsFont($validated, $font);
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de création");
        }
        return Utility::responseValid("font créé",$newFont, 201);
    }

    public function defineParamsFont($params, $font)
    {
        $font->font_name = $params->name;
        $font->font_font = $params->font;
        $font->save();
        return  new FontResource($font);
    }

    public function updateOnline(Font $font)
    {
        try{
            $font->online =  !$font->online;
            $font->save();
        }catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur modification font online");
        }
        return Utility::responseValid("online font modifiée");
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Font  $font
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return Font::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Font  $font
     * @return \Illuminate\Http\Response
     */
    public function update(FontStoreRequest $request, Font $font)
    {
        $validated = (object)$request->validated();
        try{
            $this->defineParamsFont($validated, $font);
        }catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de modification");
        }
        return Utility::responseValid("font modifiée");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Font  $font
     * @return \Illuminate\Http\Response
     */
    public function destroy(Font $font)
    {
        try {
            $font->delete();
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de suppression");
        }
        return Utility::responseValid("font supprimée");
    }
}
