<?php

namespace App\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductStats extends JsonResource
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
            'idProvider' => $this->id_provider,
            'descProvider' => $this->desc_provider,
            'idClothingSizeType' => $this->id_clothing_size_type,
            'idProductType' => $this->id_product_type,
            'descProductType' => $this->desc_product_type,
            'image' => $this->immagine,
            'productCode' => $this->codice_articolo,
            'productDesc' => $this->descrizione_articolo,
            'barcode' => $this->barcode,
            'price' => $this->prezzo,
            'totalQuantity' => $this->total_quantity,
            // 'colorVariants' => $this->color_variants,
            'date' => $this->date,
        ];
    }
}
