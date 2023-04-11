<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Resources\Order\Order as OrderResource;
use App\Resources\Order\OrderProduct as OrderProductResource;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        return OrderResource::collection(Order::orderBy('id', 'ASC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllWithPagination($orderBy, $ascDesc, $perPage, $page)
    {
        $obj = Order::orderBy($orderBy, $ascDesc)->paginate($perPage, ['*'], 'page', $page);
        return OrderResource::collection($obj);
    }

    public function getById($id)
    {
        $order = Order::findOrFail($id);
        $order['product_list'] = $this->getProductListByIdProduct($id);
        return new OrderResource($order);
    }

    public function getProductListByIdProduct($id) {
        $orderProducts =
            OrderProduct::join('product_variants', 'product_variants.id', '=', 'order_products.id_product_variant')
            ->join('products', 'product.id', '=', 'order_products.id_product')
            -> where('order_products.id_product', $id)->orderBy('id', 'ASC')
            ->get();
        return  OrderProductResource::collection($orderProducts);
    }
}
