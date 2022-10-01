<?php

namespace App\Http\Resources;

use App\Http\Controllers\MethodController;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassNameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"          => $this->id,
            "name"        => $this->name,
            "description" => $this->description,
            "class_patch" => $this->class_patch,
            "list_method" => MethodController::processingMethod($this)
        ];
    }
}
