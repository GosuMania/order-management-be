<?php

namespace App\Http\Controllers;

use App\Resources\Customer\User as CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
Use Carbon\Carbon;

class CustomerController extends Controller
{

    public function getAll()
    {
        return CustomerResource::collection(Customer::orderBy('ragione_sociale', 'ASC')->get());
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
        $user = Auth::user();
        if ($user->subscription_level < 4) {
            return response()->json(['message' => 'Unauthorized'], 401);
        } else {
            return Customer::where('id', $id)->delete();
        }

    }
}
