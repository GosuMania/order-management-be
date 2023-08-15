<?php

namespace App\Http\Controllers;

use App\Models\ClothingNumberSize;
use App\Models\ClothingSize;
use App\Models\Color;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ProductType;
use App\Models\ProductVariant;
use App\Models\Provider;
use App\Models\ShoeSize;
use App\Resources\Order\Order as OrderResource;
use App\Resources\Order\OrderProduct as OrderProductResource;
use App\Resources\Product\ProductOrder as ProductOrderResource;

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
        $orderProducts = OrderProduct::where('order_products.id_order', $id)
            ->join('products', 'products.id', '=', 'order_products.id_product')
            ->join('product_variants', 'product_variants.id', '=', 'order_products.id_product_variant')
            ->get();
        $providers = Provider::orderBy('id', 'ASC')->get();
        $productTypes = ProductType::orderBy('id', 'ASC')->get();
        $colors = Color::orderBy('id', 'ASC')->get();
        $showSizes = ShoeSize::orderBy('id', 'ASC')->get();
        $clothingSizes = ClothingSize::orderBy('id', 'ASC')->get();
        $clothingNumberSizes = ClothingNumberSize::orderBy('id', 'ASC')->get();
        $orderProductsNew = $this->groupAndMergeVariants($orderProducts, $providers, $productTypes, $colors, $showSizes, $clothingSizes, $clothingNumberSizes, $orderProductsNew);

        return ProductOrderResource::collection($orderProductsNew);
        /*
        $orderProducts =
            OrderProduct::join('product_variants', 'product_variants.id', '=', 'order_products.id_product_variant')
                ->join('products', 'products.id', '=', 'order_products.id_product')
                ->where('order_products.id_product', $id)->orderBy('order_products.id', 'ASC')
                ->get();
        return OrderProductResource::collection($orderProducts);
        */
    }

    public function groupAndMergeVariants($inputArray, $providers, $productTypes, $colors, $showSizes, $clothingSizes, $clothingNumberSizes, $orderProductsNew)
    {
        $groupedArray = [];

        // Raggruppa gli oggetti in base all'id_product
        $groupedProducts = collect($inputArray)->groupBy('id_product');

        foreach ($groupedProducts as $id_product => $products) {
            $mergedProduct = $products[0]; // Prendi il primo oggetto come base per il merge
            /*
            $colorVariants = [];

            foreach ($products as $product) {
                $colorVariant = [
                    'id' => $product['id'],
                    'id_product_variant' => $product['id_product_variant'],
                    'quantity' => $product['quantity'],
                    'stock' => $product['stock'],
                ];

                $colorVariants[] = $colorVariant;
            }
            */

            $mergedProduct['color_variants'] = $this->getColorVariants($products, $mergedProduct['id_product_type'], $colors, $showSizes, $clothingSizes, $clothingNumberSizes);
            $groupedArray[] = $mergedProduct;
        }

        return $groupedArray;
    }

    public function getColorVariants($productVariants, $idProductType, $colors, $showSizes, $clothingSizes, $clothingNumberSizes)
    {
        $colorVariants = [];
        $sizeVariants = [];
        $i = -1;
        $j = 0;
        foreach ($productVariants as $productVariant) {
            if ($i == -1) {
                $i = $i + 1;
                $colorVariants[$i]['id'] = $productVariant['id_color'];
                $colorVariants[$i]['descColor'] = $this->getDescColor($colors, $productVariant['id_color']);
            } else if ($colorVariants[$i]['id'] != $productVariant['id_color']) {
                $colorVariants[$i]['sizeVariants'] = $sizeVariants;
                $i = $i + 1;
                $colorVariants[$i]['id'] = $productVariant['id_color'];
                $colorVariants[$i]['descColor'] = $this->getDescColor($colors, $productVariant['id_color']);
                $sizeVariants = []; // inizialitto di nuovo array sizeVariants
                $j = 0; // azzero contatore array sizeVariant
            } else {
                $j = $j + 1;
            }

            switch ($idProductType) {
                case 0:
                    if ($productVariant['id_clothing_size_type'] == 1) {
                        if (isset($clothingSizes[$productVariant['id_clothing_size']])) {
                            $sizeVariants[$j]['id'] = $productVariant['id_clothing_size'];
                            $sizeVariants[$j]['idProductVariant'] = $productVariant['id'];
                            $sizeVariants[$j]['descSize'] = $this->getDescSize($clothingSizes, $productVariant['id_clothing_size']);
                            $sizeVariants[$j]['stock'] = $productVariant['stock'];
                            $sizeVariants[$j]['stockOrder'] = $productVariant['quantity'];
                        }
                    } else {
                        if (isset($clothingNumberSizes[$productVariant['id_clothing_number_size']])) {
                            $sizeVariants[$j]['id'] = $productVariant['id_clothing_number_size'];
                            $sizeVariants[$j]['idProductVariant'] = $productVariant['id'];
                            $sizeVariants[$j]['descSize'] = $this->getDescSize($clothingNumberSizes, $productVariant['id_clothing_number_size']);
                            $sizeVariants[$j]['stock'] = $productVariant['stock'];
                            $sizeVariants[$j]['stockOrder'] = $productVariant['quantity'];
                        }
                    }
                    break;
                case 2:
                    if (isset($showSizes[$productVariant['id_shoe_size']])) {
                        $sizeVariants[$j]['id'] = $productVariant['id_shoe_size'];
                        $sizeVariants[$j]['idProductVariant'] = $productVariant['id'];
                        $sizeVariants[$j]['descSize'] = $this->getDescSize($showSizes, $productVariant['id_shoe_size']);
                        $sizeVariants[$j]['stock'] = $productVariant['stock'];
                        $sizeVariants[$j]['stockOrder'] = $productVariant['quantity'];
                    }
                    break;
                default:
                    $colorVariants[$i]['idProductVariant'] = $productVariant['id'];
                    $colorVariants[$i]['stock'] = $productVariant['stock'];
                    $colorVariants[$j]['stockOrder'] = $productVariant['quantity'];
            }
        }
        if (count($colorVariants) > 0) {
            $colorVariants[$i]['sizeVariants'] = $sizeVariants;
        }
        return $colorVariants;
    }

    public function getDescColor($colors, $id)
    {
        foreach ($colors as $color) {
            if ($color['id'] == $id) {
                return $color['colore'];
            }
        }
        return '';
    }

    public function getDescSize($sizes, $id)
    {
        foreach ($sizes as $size) {
            if ($size['id'] == $id) {
                return $size['desc'];
            }
        }
        return '';
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
                                'id_product_variant' => $sizeVariant['idProductVariant'],
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
                            'id_product_variant' => $colorVariant['idProductVariant'],
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
