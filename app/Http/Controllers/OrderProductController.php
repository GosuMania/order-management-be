<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrderProductStats($idProvider)
    {
        $query = DB::table('order_products')
            ->select('products.id', 'products.id_provider', 'products.desc_provider', 'products.id_product_type', 'products.desc_product_type', 'products.id_clothing_size_type', 'products.immagine', 'products.codice_articolo', 'products.descrizione_articolo', 'products.barcode', 'products.prezzo', DB::raw('SUM(order_products.quantity) as total_quantity'))
            ->join('products', 'order_products.id_product', '=', 'products.id')
            ->groupBy('products.id', 'products.id_provider', 'products.desc_provider', 'products.id_product_type', 'products.desc_product_type', 'products.id_clothing_size_type', 'products.immagine', 'products.codice_articolo', 'products.descrizione_articolo', 'products.barcode', 'products.prezzo')
            ->orderBy('total_quantity', 'desc');

        if (!empty($idProvider)) {
            $query->where('products.id_provider', $idProvider);
        }

        $results = $query->get();

        return response()->json(["data" => $results], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function show(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderProduct $orderProduct)
    {
        //
    }


}
