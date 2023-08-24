<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Resources\Provider\Provider as ProviderResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function getAll()
    {
        return ProviderResource::collection(Provider::orderBy('ragione_sociale', 'ASC')->get());
    }

    public function getAllWithPagination($orderBy, $ascDesc, $perPage, $page)
    {
        return ProviderResource::collection(Provider::orderBy($orderBy, $ascDesc)->paginate($perPage, ['*'], 'page', $page));
    }

    public function getAllWithPaginationSearch($word, $orderBy, $ascDesc, $perPage, $page)
    {
        return ProviderResource::collection(Provider::
        where('ragione_sociale', 'LIKE', "%$word%")
            ->orWhere('partiva_iva', 'LIKE', "%$word%")
            ->orWhere('provincia', 'LIKE', "%$word%")
            ->orWhere('telefono', 'LIKE', "%$word%")
            ->orWhere('email', 'LIKE', "%$word%")
            ->orderBy($orderBy, $ascDesc)->paginate($perPage, ['*'], 'page', $page));
    }


    public function createOrUpdate(Request $request)
    {
        $object = Provider::updateOrCreate(
            ['id' => $request->id],
            [
                'ragione_sociale' => $request->ragioneSociale,
                'partiva_iva' => $request->piva,
                'codice_fiscale' => $request->codiceFiscale,
                'codice_sdi' => $request->codiceSdi,
                'pec' => $request->pec,
                'indirizzo' => $request->indirizzo,
                'cap' => $request->cap,
                'localita' => $request->localita,
                'provincia' => $request->provincia,
                'paese' => $request->paese,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'date' => Carbon::now(),
            ]
        );
        return response()->json(['data' => new ProviderResource($object)], 200);
    }

    public function getById($id)
    {
        return new ProviderResource(Provider::findOrFail($id));
    }

    public function delete($id)
    {
        $customer = Provider::where('id', $id)->first();
        return $customer->delete();
    }
}
