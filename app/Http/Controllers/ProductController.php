<?php

namespace App\Http\Controllers;

use App\Models\ClothingSize;
use App\Models\ShoeSize;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductVariant;
use App\Models\Provider;
use App\Http\Controllers\Controller;
use App\Resources\Product\Product as ProductResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

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
        $obj = Product::orderBy($orderBy, $ascDesc)->paginate($perPage, ['*'], 'page', $page);
        $providers = Provider::orderBy('id', 'ASC')->get();
        $productTypes = ProductType::orderBy('id', 'ASC')->get();
        $colors = Color::orderBy('id', 'ASC')->get();
        $showSizes = ShoeSize::orderBy('id', 'ASC')->get();
        $clothingSizes = ClothingSize::orderBy('id', 'ASC')->get();
        // $products = $obj->data;
        // return $products;
        foreach ($obj as $product) {
            $product['desc_provider'] = $this->getDescProviderById($product['id_provider'], $providers);
            $product['desc_product_type'] = $this->getDescProductTypeById($product['id_product_type'], $productTypes);
            $product['color_variants'] = $this->getColorVariants($product['id'], $product['id_product_type'], $colors, $showSizes, $clothingSizes);
        }
        return ProductResource::collection($obj);
    }

    public function getDescProviderById($id, $array)
    {
        if (isset($array[$id])) {
            return $array[$id]['ragione_sociale'];
        }
        return false;
    }

    public function getDescProductTypeById($id, $array)
    {
        if (isset($array[$id])) {
            return $array[$id]['type'];
        }
        return false;
    }

    public function getColorVariants($id, $idProductType, $colors, $showSizes, $clothingSizes)
    {
        $productVariants = ProductVariant::where('id_product', $id)->orderBy('id_product', 'ASC')->get();
        $colorVariants = [];
        $sizeVariants = [];
        $i = -1;
        $j = 0;
        foreach ($productVariants as $productVariant) {
            if ($i == -1) {
                $i = $i + 1;
                $colorVariants[$i]['id'] = $productVariant['id_color'];
                $colorVariants[$i]['descColor'] = $colors[$productVariant['id_color']]['colore'];
            } else if ($colorVariants[$i]['id'] != $productVariant['id_color']) {
                $colorVariants[$i]['sizeVariants'] = $sizeVariants;
                $i = $i + 1;
                $colorVariants[$i]['id'] = $productVariant['id_color'];
                $colorVariants[$i]['descColor'] = $colors[$productVariant['id_color']]['colore'];
                $sizeVariants = []; // inizialitto di nuovo array sizeVariants
                $j = 0; // azzero contatore array sizeVariant
            } else {
                $j = $j + 1;
            }

            switch ($idProductType) {
                case 0:
                    if (isset($clothingSizes[$productVariant['id_clothing_size']])) {
                        $sizeVariants[$j]['id'] = $productVariant['id_clothing_size'];
                        $sizeVariants[$j]['descSize'] = $clothingSizes[$productVariant['id_clothing_size']]['size'];
                        $sizeVariants[$j]['stock'] = $productVariant['stock'];
                    }
                    break;
                case 2:
                    if (isset($showSizes[$productVariant['id_shoe_size']])) {
                        $sizeVariants[$j]['id'] = $productVariant['id_shoe_size'];
                        $sizeVariants[$j]['descSize'] = $showSizes[$productVariant['id_shoe_size']]['size'];
                        $sizeVariants[$j]['stock'] = $productVariant['stock'];
                    }
                    break;
                default:
                    $colorVariants[$i]['stock'] = $productVariant['stock'];
            }
        }
        if (count($colorVariants) > 0) {
            $colorVariants[$i]['sizeVariants'] = $sizeVariants;
        }
        return $colorVariants;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdate(Request $request)
    {
        $object = Product::updateOrCreate(
            ['id' => $request->id],
            [
                'id_provider' => $request->idProvider,
                'id_product_type' => $request->idProductType,
                'immagine' => $request->image,
                'codice_articolo' => $request->productCode,
                'descrizione_articolo' => $request->productDesc,
                'prezzo' => $request->price,
                'date' => Carbon::now()
            ]
        );
        ProductVariant::where('id_product', $request->id)->delete();
        foreach ($request->colorVariants as $colorVariant) {
            if (count($colorVariant['sizeVariants']) > 0) {
                foreach ($colorVariant['sizeVariants'] as $sizeVariant) {
                    $idShoe = null;
                    $idClothing = null;
                    switch ($request->idProductType) {
                        case 0:
                            $idClothing = $sizeVariant['id'];
                            break;
                        case 2:
                            $idShoe = $sizeVariant['id'];
                            break;
                        default:
                    }
                    $productVariant = ProductVariant::create([
                        'id_product' => $object->id,
                        'id_product_type' => $request->idProductType,
                        'id_color' => $colorVariant['id'],
                        'id_clothing_size' => $idClothing,
                        'id_shoe_size' => $idShoe,
                        'stock' => $sizeVariant['stock'],
                        'date' => Carbon::now()

                    ]);
                }
            } else {
                $productVariant = ProductVariant::create([
                    'id_product' => $object->id,
                    'id_product_type' => $request->idProductType,
                    'id_color' => $colorVariant['id'],
                    'id_clothing_size' => null,
                    'id_shoe_size' => null,
                    'stock' => $colorVariant['stock'],
                    'date' => Carbon::now()
                ]);
            }
        }
        return response()->json(['data' => new ProductResource($object)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ProductVariant $product
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVariant $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ProductVariant $product
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVariant $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductVariant $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVariant $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ProductVariant $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVariant $product)
    {
        //
    }
}
