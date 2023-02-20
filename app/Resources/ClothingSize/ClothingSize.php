<?php

namespace App\Resources\ClothingSize;

use Illuminate\Http\Resources\Json\JsonResource;
class ClothingSize extends JsonResource
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
            'size' => $this->size,
            'date' => $this->date
        ];
    }
}
