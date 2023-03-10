<?php

namespace App\Http\Controllers;

use App\Resources\Customer\Customer as CustomerResource;
use App\Resources\Customer\CustomerPagination as CustomerPaginationResource;


use App\Models\Customer;
use Illuminate\Http\Request;
Use Carbon\Carbon;

class CustomerController extends Controller
{

    public function getAll()
    {
        return CustomerResource::collection(Customer::orderBy('ragione_sociale', 'ASC')->get());
    }

    public function getAllWithPagination($orderBy, $ascDesc, $perPage, $page)
    {
        return CustomerResource::collection(Customer::orderBy($orderBy, $ascDesc)->paginate($perPage, ['*'], 'page', $page));
    }

    public function createOrUpdate(Request $request)
    {
            $object = Customer::updateOrCreate(
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
                    'indirizzo_dm' => $request->destinazioneMerce['indirizzo'],
                    'cap_dm' => $request->destinazioneMerce['cap'],
                    'localita_dm' => $request->destinazioneMerce['localita'],
                    'provincia_dm' => $request->destinazioneMerce['provincia'],
                    'paese_dm' => $request->destinazioneMerce['paese'],
                    'id_agente_riferimento' => $request->idAgenteRiferimento,
                    'username_agente_riferimento' => $request->usernameAgenteRiferimento,
                    'date' => Carbon::now(),
                ]
            );
            return response()->json(['data' => new CustomerResource($object)], 200);
    }

    public function getById($id)
    {
        return new CustomerResource(Customer::findOrFail($id));
    }

    public function delete($id)
    {
        $customer = Customer::where('id', $id)->first();
        return $customer->delete();
    }
}
