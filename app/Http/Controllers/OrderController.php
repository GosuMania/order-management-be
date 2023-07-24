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
        $object = Order::updateOrCreate(
            ['id' => $request->id],
            [
                'id_provider' => $request->idProvider,
                'desc_provider' => $request->descProvider,
                'id_product_type' => $request->idProductType,
                'desc_product_type' => $request->descProductType,
                'immagine' => $request->image,
                'codice_articolo' => $request->productCode,
                'descrizione_articolo' => $request->productDesc,
                'prezzo' => $request->price,
                'date' => Carbon::now()
            ]
        );
        OrderProduct::where('id_product', $request->id)->delete();
        foreach ($request->productList as $product) {
            foreach ($product->colorVariants as $colorVariant) {
                if (count($colorVariant['sizeVariants']) > 0) {
                    foreach ($colorVariant['sizeVariants'] as $sizeVariant) {
                        $objectOrderProduct = OrderProduct::create(
                            [
                                'id_order' => $object->id,
                                'id_product' => $product->id,
                                'id_product_variant' => $sizeVariant->id,
                                'quantity' => $sizeVariant->stock,
                                'date' => Carbon::now()
                            ]
                        );
                    }
                } else {
                    $objectOrderProduct = OrderProduct::create(
                        [
                            'id_order' => $object->id,
                            'id_product' => $product->id,
                            'id_product_variant' => $colorVariant->id,
                            'quantity' => $colorVariant->stock,
                            'date' => Carbon::now()
                        ]
                    );
                }
            }

        }
        $id = $object->id;
        $object = $request;
        $object['id'] = $id;
        return response()->json(['data' => new OrderResource($object)], 200);
    }

    public function delete($id)
    {
        $product = Order::where('id', $id)->first();
        return $product->delete();
    }
}
