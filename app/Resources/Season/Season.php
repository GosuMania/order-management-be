<?php

namespace App\Resources\Season;

use Illuminate\Http\Resources\Json\JsonResource;
class Season extends JsonResource
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
            'desc' => $this->desc_season_type,
            'year' => $this->year,
            'startDate' => $this->start_date,
            'finalDate' => $this->final_date,

        ];
    }
}
