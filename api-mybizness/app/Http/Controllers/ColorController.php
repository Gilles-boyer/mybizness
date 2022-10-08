<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Color;
use Illuminate\Http\Request;
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
        //
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        //
    }
}
