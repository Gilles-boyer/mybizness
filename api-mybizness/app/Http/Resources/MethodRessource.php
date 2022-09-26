<?php

namespace App\Http\Resources;

use App\Http\Resources\AppWithPivotResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MethodRessource extends JsonResource
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
            "id"           => $this->id,
            "name"         => $this->name,
            "description"  => $this->description,
            "method"       => $this->method,
            "roles"        => RoleWithPivotRessource::collection($this->roles),
            "applications" => AppWithPivotResource::collection($this->apps)
        ];
    }
}
