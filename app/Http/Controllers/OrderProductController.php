<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Resources\Product\ProductStats as ProductStatsResource;
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

        if (!empty($idProvider) && $idProvider != 'null') {
            $query->where('products.id_provider', $idProvider);
        }

        $results = $query->get();
        return ProductStatsResource::collection($results);
        // return response()->json(["data" => $results], 200);
    }
    public function getOrderProductStatsWithPaginationListSearch($ascDesc, $perPage, $page, $idSeason, $idProvider)
    {
        $query = DB::table('order_products')
            ->select('products.id', 'products.id_provider', 'products.desc_provider', 'products.id_product_type', 'products.desc_product_type', 'products.id_clothing_size_type', 'products.immagine', 'products.codice_articolo', 'products.descrizione_articolo', 'products.barcode', 'products.prezzo', 'seasons.desc_season', DB::raw('SUM(order_products.quantity) as total_quantity'))
            ->join('products', 'order_products.id_product', '=', 'products.id')
            ->join('orders as o1', 'order_products.id_order', '=', 'o1.id')
            ->join('seasons', 'o1.id_season', '=', 'seasons.id')
            ->groupBy('products.id', 'products.id_provider', 'products.desc_provider', 'products.id_product_type', 'products.desc_product_type', 'products.id_clothing_size_type', 'products.immagine', 'products.codice_articolo', 'products.descrizione_articolo', 'products.barcode', 'products.prezzo', 'seasons.desc_season')
            ->orderBy('total_quantity', $ascDesc);

        if (!empty($idProvider) && $idProvider != 'null') {
            $query->where('products.id_provider', $idProvider);
        }

        if (!empty($idSeason) && $idSeason != 'null') {
            $query->where('o1.id_season', $idSeason);
        }

        $results = $query->paginate($perPage, ['*'], 'page', $page);

        return ProductStatsResource::collection($results);
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
