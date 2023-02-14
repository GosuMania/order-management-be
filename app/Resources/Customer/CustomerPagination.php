<?php

namespace App\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;
class CustomerPagination extends JsonResource
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
            'usernameAgenteRiferimento' => $this->username_agente_riferimento,
            'date' => $this->date,

        ];
    }

{
"current_page":1,
"data":[
{
"id":1,
"ragione_sociale":"Esempio ok srl",
"partiva_iva":"12312312311",
"codice_fiscale":"PDTLGU91D17F839F",
"codice_sdi":"1231231",
"pec":"luigi.pedata@pec.it",
"indirizzo":"Via Enrico De Nicola",
"cap":"80029",
"localita":"Sant'Antimo",
"provincia":"Napoli",
"paese":"IT",
"telefono":"3429488854",
"email":"luigipedata1991@gmail.com",
"indirizzo_dm":null,
"cap_dm":null,
"localita_dm":null,
"provincia_dm":null,
"paese_dm":null,
"id_agente_riferimento":0,
"username_agente_riferimento":"LuigiP",
"date":"2023-02-14 09:55:56"
}
],
"first_page_url":"https:\/\/malia-be.gosumania.it\/api\/customer\/get-all-with-pagination\/1?page=1",
   "from":1,
   "last_page":4,
   "last_page_url":"https:\/\/malia-be.gosumania.it\/api\/customer\/get-all-with-pagination\/1?page=4",
   "links":[
      {
          "url":null,
         "label":"&laquo; Previous",
         "active":false
      },
      {
          "url":"https:\/\/malia-be.gosumania.it\/api\/customer\/get-all-with-pagination\/1?page=1",
         "label":"1",
         "active":true
      },
      {
          "url":"https:\/\/malia-be.gosumania.it\/api\/customer\/get-all-with-pagination\/1?page=2",
         "label":"2",
         "active":false
      },
      {
          "url":"https:\/\/malia-be.gosumania.it\/api\/customer\/get-all-with-pagination\/1?page=3",
         "label":"3",
         "active":false
      },
      {
          "url":"https:\/\/malia-be.gosumania.it\/api\/customer\/get-all-with-pagination\/1?page=4",
         "label":"4",
         "active":false
      },
      {
          "url":"https:\/\/malia-be.gosumania.it\/api\/customer\/get-all-with-pagination\/1?page=2",
         "label":"Next &raquo;",
         "active":false
      }
   ],
   "next_page_url":"https:\/\/malia-be.gosumania.it\/api\/customer\/get-all-with-pagination\/1?page=2",
   "path":"https:\/\/malia-be.gosumania.it\/api\/customer\/get-all-with-pagination\/1",
   "per_page":1,
   "prev_page_url":null,
   "to":1,
   "total":4
}
}
