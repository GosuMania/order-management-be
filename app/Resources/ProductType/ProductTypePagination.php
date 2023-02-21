<?php

namespace App\Resources\ProductType;

use Illuminate\Http\Resources\Json\JsonResource;
class ProductTypePagination extends JsonResource
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
                'fornitore' => $this->fornitore,
                'codiceArticolo' => $this->codice_articolo,
                'descrizioneArticolo' => $this->descrizione_articolo,
                'prezzo' => $this->prezzo,
                'date' => $this->date,
            ],
        ];
    }
}
