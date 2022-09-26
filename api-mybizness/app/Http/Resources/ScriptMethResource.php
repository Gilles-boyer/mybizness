<?php

namespace App\Http\Resources;

use App\Models\Method;
use App\Http\Resources\SubScriptResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ScriptMethResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $method = Method::find($this->fk_method_id);
        return [
            "id" => $this->id,
            "name" => $method->name,
            "description" => $method->description,
            "method"    => $method->method,
            "script_id" => $this->fk_script_id,
            "method_id" => $this->fk_method_id,
            "order"     => $this->order,
            "list_method" => SubScriptResource::collection($this->subScripts)
        ];
    }
}
