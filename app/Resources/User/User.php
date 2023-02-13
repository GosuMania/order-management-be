<?php

namespace App\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
class User extends JsonResource
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
            'username' => $this->name,
            'piva' => $this->email,
            'email' => $this->codice_fiscale,
            'typeAccount' => $this->type,
            'agency' => $this->agency,
        ];
    }
}
