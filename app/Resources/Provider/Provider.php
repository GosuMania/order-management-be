<?php

namespace App\Resources\Provider;

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
            'ragioneSociale' => $this->ragione_sociale,
            'piva' => $this->partiva_iva,
            'codiceFiscale' => $this->codice_fiscale,
            'codiceSdi' => $this->codice_sdi,
            'pec' => $this->pec,
            'indirizzo' =>  $this->indirizzo,
            'cap' => $this->cap,
            'localita' => $this->localita,
            'provincia' => $this->provincia,
            'paese' => $this->paese,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'date' => $this->date,
        ];
    }
}
