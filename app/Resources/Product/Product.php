<?php

namespace App\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
class Product extends JsonResource
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
            'colore' => $this->colore,
            'codice' => $this->codice,
            'date' => $this->date,
        ];
    }
}
