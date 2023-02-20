<?php

namespace App\Resources\Customer;

use App\Resources\Customer\Customer as CustomerResource;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerPagination extends JsonResource
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
            'currentPage' => $this->current_page,
            'perPage' => $this->per_page,
            'total' => $this->total,
            'lastPage' => $this->last_page,
            'customers' => $this->data
        ];
    }
}
