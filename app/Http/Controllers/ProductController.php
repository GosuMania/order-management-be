<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use App\Resources\Product\Product as ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        return ProductResource::collection(Product::orderBy('id', 'ASC')->get());
    }

    public function getAllWithPagination($orderBy, $ascDesc, $perPage, $page)
    {
        $obj = ProductResource::collection(Product::orderBy($orderBy, $ascDesc)->paginate($perPage, ['*'], 'page', $page));
        $products = $obj->data;
        return $products;

        foreach($obj->data as $product) {
            $product['descrizioneArticolo'] = "ciao";
        }
        return $obj;
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
     * @param  \App\Models\ProductVariant  $product
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVariant $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductVariant  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVariant $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductVariant  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVariant $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVariant  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVariant $product)
    {
        //
    }
}
