<?php

namespace App\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;
class Customer extends JsonResource
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
            'destinazioneMerce' => [
                'indirizzo' => $this->indirizzo_dm,
                'cap' =>  $this->cap_dm,
                'localita' => $this->localita_dm,
                'provincia' => $this->provincia_dm,
                'paese' => $this->paese_dm
            ],
            'idAgenteRiferimento' => $this->id_agente_riferimento,
            'date' => $this->date,

        ];
    }
}
