<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Font;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\FontOnlineResource;


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
        //
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
     * @param  \App\Models\Font  $font
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return Font::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Font  $font
     * @return \Illuminate\Http\Response
     */
    public function edit(Font $font)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Font  $font
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Font $font)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Font  $font
     * @return \Illuminate\Http\Response
     */
    public function destroy(Font $font)
    {
        //
    }
}
