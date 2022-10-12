<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageStoreRequest;
use Exception;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ImageOnlineResource;
use App\Http\Resources\ImageResource;
use BaconQrCode\Renderer\ImageRenderer;
use PhpParser\Node\Stmt\TryCatch;

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
        return ImageResource::collection(Image::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageStoreRequest $request)
    {
        $validated = (object)$request->validated();
        $image = new Image();

        try {
            $newImage = $this->defineParamsImage($validated, $image);
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de création");
        }
        return Utility::responseValid("image créé",$newImage, 201);
    }

    public function defineParamsImage($params, $image)
    {
        $image->image_name = $params->name;
        $image->image_description = $params->description;
        $image->image_src = $params->url;
        $image->save();

        return  new ImageResource($image);
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

    public function updateOnline(Image $image)
    {
        try{
            $image->online =  !$image->online;
            $image->save();
        }catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur modification image online");
        }
        return Utility::responseValid("online image modifiée");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(ImageStoreRequest $request, Image $image)
    {
        $validated = (object)$request->validated();

        try{
            $this->defineParamsImage($validated, $image);
        }catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de modification");
        }
        return Utility::responseValid("image modifiée");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        try {
            $image->delete();
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de suppression");
        }
        return Utility::responseValid("image supprimée");
    }
}
