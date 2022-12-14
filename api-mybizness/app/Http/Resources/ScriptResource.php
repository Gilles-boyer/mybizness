<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScriptResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $collection = ScriptMethodResource::collection($this->methods);
        $sorted = $collection->sortBy("pivot.order");
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
        ];
    }
}
