<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Resources\Order\Order as OrderResource;
use App\Resources\Order\OrderProduct as OrderProductResource;
use Carbon\Carbon;

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

    public function getAllWithPaginationSearch($word, $orderBy, $ascDesc, $perPage, $page)
    {
        $obj = Order::where('id', 'LIKE', "%$word%")
            ->orWhere('desc_user', 'LIKE', "%$word%")
            ->orWhere('desc_customer', 'LIKE', "%$word%")
            ->orWhere('date', 'LIKE', "%$word%")
            ->orWhere('desc_delivery', 'LIKE', "%$word%")
            ->orWhere('desc_season', 'LIKE', "%$word%")
            ->orderBy($orderBy, $ascDesc)->paginate($perPage, ['*'], 'page', $page);
        return OrderResource::collection($obj);
    }

    public function getById($id)
    {
        $order = Order::findOrFail($id);
        $order['product_list'] = $this->getProductListByIdProduct($id);
        return new OrderResource($order);
    }

    public function getProductListByIdProduct($id)
    {
        $orderProducts =
            OrderProduct::join('product_variants', 'product_variants.id', '=', 'order_products.id_product_variant')
                ->join('products', 'products.id', '=', 'order_products.id_product')
                ->where('order_products.id_product', $id)->orderBy('order_products.id', 'ASC')
                ->get();
        return OrderProductResource::collection($orderProducts);
    }

    public function getTotalPiecesAndAmounts()
    {
        $orders = Order::select(
            'total_pieces',
            'total_amount'
        )->get();
        $totalPieces = 0;
        $totalAmount = 0;
        foreach ($orders as $obj) {
            $totalPieces = $totalPieces + $obj['total_pieces'];
            $totalAmount = $totalAmount + $obj['total_amount'];
        }
        $data['totalPieces'] = $totalPieces;
        $data['totalAmount'] = $totalAmount;
        return response()->json(["data" => $data], 200);

    }

    public function createOrUpdate(Request $request)
    {
        $objectOrder = Order::updateOrCreate(
            ['id' => $request->id],
            [
                'id_user' => $request->idUser,
                'desc_user' => $request->descUser,
                'id_customer' => $request->idCustomer,
                'desc_customer' => $request->descCustomer,
                'id_order_type' => $request->idOrderType,
                'desc_order_type' => $request->descOrderType,
                'id_payment_methods' => $request->idPaymentMethods,
                'desc_payment_methods' => $request->descPaymentMethods,
                'id_season' => $request->idSeason,
                'desc_season' => $request->descSeason,
                'id_delivery' => $request->idDelivery,
                'desc_delivery' => $request->descDelivery,
                'total_amount' => $request->totalAmount,
                'total_pieces' => $request->totalPieces,
                'date' => Carbon::now()
            ]
        );
        OrderProduct::where('id_product', $request->id)->delete();
        foreach ($request->productList as $product) {
            foreach ($product['colorVariants'] as $colorVariant) {
                if (count($colorVariant['sizeVariants']) > 0) {
                    foreach ($colorVariant['sizeVariants'] as $sizeVariant) {
                        $objectOrderProduct = OrderProduct::create(
                            [
                                'id_order' => $objectOrder->id,
                                'id_product' => $product['id'],
                                'id_product_variant' => $sizeVariant['id'],
                                'quantity' => $sizeVariant['stock'],
                                'date' => Carbon::now()
                            ]
                        );
                    }
                } else {
                    $objectOrderProduct = OrderProduct::create(
                        [
                            'id_order' => $objectOrder->id,
                            'id_product' => $product['id'],
                            'id_product_variant' => $colorVariant['id'],
                            'quantity' => $colorVariant['stock'],
                            'date' => Carbon::now()
                        ]
                    );
                }
            }

        }
        $object = $request;
        $object['id'] = $objectOrder->id;
        return response()->json(['data' => new OrderResource($object)], 200);
    }

    public function delete($id)
    {
        $product = Order::where('id', $id)->first();
        return $product->delete();
    }
}
