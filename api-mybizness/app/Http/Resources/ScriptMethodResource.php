<?php

namespace App\Http\Resources;

use App\Models\ScriptMehod;
use Illuminate\Http\Resources\Json\JsonResource;

class ScriptMethodResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $subScripts = ScriptMehod::where('fk_script_mehods_id', $this->pivot->id)->get();

        return [
            "id" => $this->pivot->id,
            "name" => $this->name,
            "description" => $this->description,
            "script_id" => $this->pivot->fk_script_id,
            "method_id" => $this->pivot->fk_method_id,
            "order"     => $this->pivot->order,
            "list_method" => ScriptMethResource::collection($subScripts),
        ];
    }
}
