<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Http\Controllers\Controller;
use App\Resources\Color\Color as ColorResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ColorController extends Controller
{

    public function getAll()
    {
        return ColorResource::collection(Color::orderBy('id', 'ASC')->get());
    }

    public function getAllWithPagination($orderBy, $ascDesc, $perPage, $page)
    {
        return ColorResource::collection(Color::orderBy($orderBy, $ascDesc)->paginate($perPage, ['*'], 'page', $page));
    }

    public function getAllWithPaginationSearch($word, $orderBy, $ascDesc, $perPage, $page)
    {
        return ColorResource::collection(Color::
        where('colore', 'LIKE', "%$word%")
            ->orderBy($orderBy, $ascDesc)->paginate($perPage, ['*'], 'page', $page));
    }


    public function createOrUpdate(Request $request)
    {
        $object = Color::updateOrCreate(
            ['id' => $request->id],
            [
                'colore' => $request->ragioneSociale,
                'codice' => $request->codice,
            ]
        );
        return response()->json(['data' => new ColorResource($object)], 200);
    }

    public function getById($id)
    {
        return new ColorResource(Color::findOrFail($id));
    }

    public function delete($id)
    {
        $customer = Color::where('id', $id)->first();
        return $customer->delete();
    }
}
