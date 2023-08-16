<?php

namespace App\Resources\OrderDetail;

use Illuminate\Http\Resources\Json\JsonResource;
class OrderDetail extends JsonResource
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
            'totalPieces' => $this->total_price,
            'totalAmount' => $this->total_amount,
            'date' => $this->date,
            'status' => $this->status,
            'productList' => $this->product_list
        ];
    }
}
