<?php

namespace App\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;
class OrderProduct extends JsonResource
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
            'idOrder' => $this->id_order,
            'idProduct' => $this->id_product,
            'idProductVariant' => $this->id_product_variant,
            'idProductType' => $this->id_product_type,
            'idColor' => $this->id_color,
            'idClothingSize' => $this->id_clothing_size,
            'idShoeSize' => $this->id_shoe_size,
            'stock' => $this->stock,
            'date' => $this->date,
            'quantity' => $this->quantity
        ];
    }
}
