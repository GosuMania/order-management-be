<?php

namespace App\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
class ProductPagination extends JsonResource
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
            'data' => [
                'id' => $this->id,
                'colore' => $this->colore,
                'codice' => $this->codice,
                'date' => $this->date,
            ],
        ];
    }
}
