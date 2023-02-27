<?php

namespace App\Resources\Color;

use Illuminate\Http\Resources\Json\JsonResource;
class Provider extends JsonResource
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
            'id' => $this->id,
            'ragioneSociale' => $this->ragione_sociale
        ];
    }
}
