<?php

namespace App\Resources\Order;

use App\Resources\Product\Product as ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;
class OrderPDF extends JsonResource
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
            'idUser' => $this->id_user,
            'descUser' => $this->desc_user,
            'idCustomer' => $this->id_customer,
            'codiceSdi' => $this->codice_sdi,
            'descCustomer' => $this->desc_customer,
            'idOrderType' =>  $this->id_order_type,
            'descOrderType' => $this->desc_order_type,
            'idPaymentMethods' => $this->id_payment_methods,
            'descPaymentMethods' => $this->desc_payment_methods,
            'idSeason' => $this->id_season,
            'descSeason' => $this->desc_season,
            'idDelivery' => $this->id_delivery,
            'descDelivery' => $this->desc_delivery,
            'totalPieces' => $this->total_pieces,
            'totalAmount' => $this->total_amount,
            'productList' => $this->product_list,
            'status' => $this->status,
            // 'productList' => ProductResource::collection($this->product_list),
            'date' => $this->date,
        ];
    }
}
