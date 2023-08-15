<?php

namespace App\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductOrder extends JsonResource
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
            'id_product' => $this->id,
            'idProvider' => $this->id_provider,
            'descProvider' => $this->desc_provider,
            'idClothingSizeType' => $this->id_clothing_size_type,
            'idProductType' => $this->id_product_type,
            'descProductType' => $this->desc_product_type,
            'image' => $this->immagine,
            'productCode' => $this->codice_articolo,
            'productDesc' => $this->descrizione_articolo,
            'price' => $this->prezzo,
            'colorVariants' => $this->color_variants,
            'quantity' => $this->quantity,
            'stock' => $this->stock,
            'date' => $this->date,
        ];
    }
}
