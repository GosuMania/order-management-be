<?php

namespace App\Http\Controllers;

use App\Models\ClothingNumberSize;
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
        $clothingNumberSizes = ClothingNumberSize::orderBy('id', 'ASC')->get();
        // $products = $obj->data;
        // return $products;
        foreach ($obj as $product) {
            $product['desc_provider'] = $this->getDescProviderById($product['id_provider'], $providers);
            $product['desc_product_type'] = $this->getDescProductTypeById($product['id_product_type'], $productTypes);
            $product['color_variants'] = $this->getColorVariants($product['id'], $product['id_product_type'], $colors, $showSizes, $clothingSizes, $clothingNumberSizes);
        }
        return ProductResource::collection($obj);
    }

    public function getAllWithPaginationSearch($word, $orderBy, $ascDesc, $perPage, $page)
    {
        $obj = Product::where('desc_provider', 'LIKE', "%$word%")
            ->orWhere('desc_product_type', 'LIKE', "%$word%")
            ->orWhere('codice_articolo', 'LIKE', "%$word%")
            ->orWhere('descrizione_articolo', 'LIKE', "%$word%")
            ->orderBy($orderBy, $ascDesc)->paginate($perPage, ['*'], 'page', $page);
        $providers = Provider::orderBy('id', 'ASC')->get();
        $productTypes = ProductType::orderBy('id', 'ASC')->get();
        $colors = Color::orderBy('id', 'ASC')->get();
        $showSizes = ShoeSize::orderBy('id', 'ASC')->get();
        $clothingSizes = ClothingSize::orderBy('id', 'ASC')->get();
        $clothingNumberSizes = ClothingNumberSize::orderBy('id', 'ASC')->get();
        // $products = $obj->data;
        // return $products;
        foreach ($obj as $product) {
            $product['desc_provider'] = $this->getDescProviderById($product['id_provider'], $providers);
            $product['desc_product_type'] = $this->getDescProductTypeById($product['id_product_type'], $productTypes);
            $product['color_variants'] = $this->getColorVariants($product['id'], $product['id_product_type'], $colors, $showSizes, $clothingSizes, $clothingNumberSizes);
        }
        return ProductResource::collection($obj);
    }

    public function getDescProviderById($id, $array)
    {
        if (isset($array[$id])) {
            return $array[$id]['ragione_sociale'];
        }
        return $id;
    }

    public function getDescProductTypeById($id, $array)
    {
        if (isset($array[$id])) {
            return $array[$id]['desc'];
        }
        return false;
    }

    public function getColorVariants($id, $idProductType, $colors, $showSizes, $clothingSizes, $clothingNumberSizes)
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
                $colorVariants[$i]['descColor'] = $this->getDescColor($colors,$productVariant['id_color']);
            } else if ($colorVariants[$i]['id'] != $productVariant['id_color']) {
                $colorVariants[$i]['sizeVariants'] = $sizeVariants;
                $i = $i + 1;
                $colorVariants[$i]['id'] = $productVariant['id_color'];
                $colorVariants[$i]['descColor'] = $this->getDescColor($colors,$productVariant['id_color']);
                $sizeVariants = []; // inizialitto di nuovo array sizeVariants
                $j = 0; // azzero contatore array sizeVariant
            } else {
                $j = $j + 1;
            }

            switch ($idProductType) {
                case 0:
                    if($productVariant['id_clothing_size_type'] == 1) {
                        if (isset($clothingSizes[$productVariant['id_clothing_size']])) {
                            $sizeVariants[$j]['id'] = $productVariant['id_clothing_size'];
                            $sizeVariants[$j]['idProductVariant'] = $productVariant['id'];
                            $sizeVariants[$j]['descSize'] = $this->getDescSize($clothingSizes,$productVariant['id_clothing_size'] );
                            $sizeVariants[$j]['stock'] = $productVariant['stock'];
                        }
                    } else {
                        if (isset($clothingNumberSizes[$productVariant['id_clothing_number_size']])) {
                            $sizeVariants[$j]['id'] = $productVariant['id_clothing_number_size'];
                            $sizeVariants[$j]['idProductVariant'] = $productVariant['id'];
                            $sizeVariants[$j]['descSize'] = $this->getDescSize($clothingNumberSizes,$productVariant['id_clothing_number_size'] );
                            $sizeVariants[$j]['stock'] = $productVariant['stock'];
                        }
                    }
                    break;
                case 2:
                    if (isset($showSizes[$productVariant['id_shoe_size']])) {
                        $sizeVariants[$j]['id'] = $productVariant['id_shoe_size'];
                        $sizeVariants[$j]['idProductVariant'] = $productVariant['id'];
                        $sizeVariants[$j]['descSize'] = $this->getDescSize($showSizes,$productVariant['id_shoe_size']);
                        $sizeVariants[$j]['stock'] = $productVariant['stock'];
                    }
                    break;
                default:
                    $colorVariants[$i]['idProductVariant'] = $productVariant['id'];
                    $colorVariants[$i]['stock'] = $productVariant['stock'];
            }
        }
        if (count($colorVariants) > 0) {
            $colorVariants[$i]['sizeVariants'] = $sizeVariants;
        }
        return $colorVariants;
    }

    public function getDescColor($colors, $id) {
        foreach ($colors as $color) {
            if($color['id'] == $id) {
                return $color['colore'];
            }
        }
        return '';
    }

    public function getDescSize($sizes, $id) {
        foreach ($sizes as $size) {
            if($size['id'] == $id) {
                return $size['desc'];
            }
        }
        return '';
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
                'desc_provider' => $request->descProvider,
                'id_product_type' => $request->idProductType,
                'id_clothing_size_type' => $request->idClothingSizeType,
                'desc_product_type'=> $request->descProductType,
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

                    if($request->idClothingSizeType == 1) {
                        $productVariant = ProductVariant::create([
                            'id_product' => $object->id,
                            'id_product_type' => $request->idProductType,
                            'id_clothing_size_type' => $request->idClothingSizeType,
                            'id_color' => $colorVariant['id'],
                            'id_clothing_size' => $idClothing,
                            'id_clothing_number_size' => null,
                            'id_shoe_size' => $idShoe,
                            'stock' => $sizeVariant['stock'],
                            'date' => Carbon::now()
                        ]);
                    } else {
                        $productVariant = ProductVariant::create([
                            'id_product' => $object->id,
                            'id_product_type' => $request->idProductType,
                            'id_clothing_size_type' => $request->idClothingSizeType,
                            'id_color' => $colorVariant['id'],
                            'id_clothing_size' => null,
                            'id_clothing_number_size' => $idClothing,
                            'id_shoe_size' => $idShoe,
                            'stock' => $sizeVariant['stock'],
                            'date' => Carbon::now()
                        ]);
                    }

                }
            } else {
                $productVariant = ProductVariant::create([
                    'id_product' => $object->id,
                    'id_product_type' => $request->idProductType,
                    'id_color' => $colorVariant['id'],
                    'id_clothing_size' => null,
                    'id_clothing_number_size' => null,
                    'id_shoe_size' => null,
                    'stock' => $colorVariant['stock'],
                    'date' => Carbon::now()
                ]);
            }
        }
        return response()->json(['data' => new ProductResource($object)], 200);
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        return $product->delete();
    }
}
