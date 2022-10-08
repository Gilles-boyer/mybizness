<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ImageOnlineResource;

/**
 * Observable : true
 * Name : Image
 * Description : image controller
 */
class ImageController extends Controller
{
    static $ruleId = [
        "id" => "required|exists:App\Models\Image,id"
    ];

    /**
     * Display a listing of the resource online.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOnline()
    {
        return ImageOnlineResource::collection(Image::where("online", true)->get());
    }

    /**
     * Observable : true
     * Name : load image
     * Description : load image by id
     */
    public function loadImage($request, $results)
    {
        if(gettype($request->personalization) === "string") {
            $results['image'] = $this->imageOnline($request->personalization);
        } else {
            $results['image'] = $this->show((int)($request->personalization)['image']);
        }
        return $results;
    }

    public function imageOnline($personalization){
        $personalization = json_decode($personalization);
        $validator = Validator::make(
            ['id' => $personalization->image],
            self::$ruleId,
            Utility::$errors
        );
        $x = $this->validatedImageId($validator);
        return  $this->show((int)$x['id']);
    }

    public function validatedImageId($validator)
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
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Image::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
