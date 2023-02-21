<?php

namespace App\Resources\ProductType;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductType extends JsonResource
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
            'fornitore' => $this->fornitore,
            'codiceArticolo' => $this->codice_articolo,
            'descrizioneArticolo' => $this->descrizione_articolo,
            // 'taglia' => $this->taglia,
            // 'idColore' => $this->id_colore,
            'prezzo' => $this->prezzo,
            // 'quantitaMagazzino' => $this->quantita_magazzino,
            // 'quantitaDisponibile' => $this->quantita_disponibile,
            'date' => $this->date,
        ];
    }
}
