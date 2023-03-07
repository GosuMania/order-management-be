<?php

namespace App\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'idProvider' => $this->id_provider,
            'descProvider' => '',
            'idProductType' => $this->id_product_type,
            'descProductType' => '',
            'immagine' => $this->immagine,
            'codiceArticolo' => $this->codice_articolo,
            'descrizioneArticolo' => $this->descrizione_articolo,
            'prezzo' => $this->prezzo,
            'date' => $this->date,
        ];
    }
}
