<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Resources\ProductType\ProductType as ProductResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TypeProductController extends Controller
{

    public function getAll()
    {
        return ProductResource::collection(Product::orderBy('codice_articolo', 'ASC')->get());
    }

    public function getAllWithPagination($orderBy, $ascDesc, $perPage, $page)
    {
        return ProductResource::collection(Product::orderBy($orderBy, $ascDesc)->paginate($perPage, ['*'], 'page', $page));
    }

    public function createOrUpdate(Request $request)
    {
        $object = Product::updateOrCreate(
            ['id' => $request->id],
            [
                'immagine' => $request->immagine,
                'fornitore' => $request->fornitore,
                'codice_articolo' => $request->codice_articolo,
                'descrizione_articolo' => $request->descrizione_articolo,
                // 'taglia' => $request->taglia,
                // 'id_colore' => $request->id_colore,
                'prezzo' => $request->prezzo,
                // 'quantita_magazzino' => $request->quantitaMagazzino,
                // 'quantita_disponibile' => $request->quantitaDisponibile,
                'date' => Carbon::now(),
            ]
        );
        return response()->json(['data' => new ProductResource($object)], 200);
    }

    public function getById($id)
    {
        return new ProductResource(Product::findOrFail($id));
    }

    public function delete($id)
    {
        $user = Auth::user();
        if ($user->subscription_level < 4) {
            return response()->json(['message' => 'Unauthorized'], 401);
        } else {
            return Product::where('id', $id)->delete();
        }

    }
}
