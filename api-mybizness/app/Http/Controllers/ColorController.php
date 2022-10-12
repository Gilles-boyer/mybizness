<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Resources\ColorResource;
use App\Http\Requests\ColorStoreRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ColorOnlineResource;

/**
 * Observable : true
 * Name : Color
 * Description : color controller
 */
class ColorController extends Controller
{
    static $ruleId = [
        "id" => "required|exists:App\Models\Color,id"
    ];


    /**
     * Observable : true
     * Name : load color
     * Description : load color by id
     */
    public function loadColor($request, $results)
    {
        if (gettype($request->personalization) === "string") {
            $results['color'] = $this->colorOnline($request->personalization);
        } else {
            $results['color'] = $this->show((int)($request->personalization)['color']);
        }
        return $results;
    }

    public function colorOnline($personalization)
    {
        $personalization = json_decode($personalization);
        $validator = Validator::make(
            ['id' => $personalization->color],
            self::$ruleId,
            Utility::$errors
        );
        $x = $this->validatedColorId($validator);
        return  $this->show((int)$x['id']);
    }

    public function validatedColorId($validator)
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
        return ColorResource::collection(Color::all());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOnline()
    {
        return ColorOnlineResource::collection(Color::where("online", true)->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorStoreRequest $request)
    {
        $validated = (object)$request->validated();
        $font = new Color();

        try {
            $newColor = $this->defineParamsColor($validated, $font);
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de création");
        }
        return Utility::responseValid("font créé",$newColor, 201);
    }

    public function defineParamsColor($params, $color)
    {
        $color->color_name = $params->name;
        $color->color_hex =  $params->hex;
        $color->save();
        return  new ColorResource($color);
    }


    public function updateOnline(Color $color)
    {
        try{
            $color->online =  !$color->online;
            $color->save();
        }catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur modification color online");
        }
        return Utility::responseValid("online color modifiée");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Color::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Font  $font
     * @return \Illuminate\Http\Response
     */
    public function update(ColorStoreRequest $request, Color $color)
    {
        $validated = (object)$request->validated();
        try{
            $this->defineParamsColor($validated, $color);
        }catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de modification");
        }
        return Utility::responseValid("color modifiée");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        try {
            $color->delete();
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de suppression");
        }
        return Utility::responseValid("Color supprimée");
    }
}
