<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'ragione_sociale',
        'partiva_iva',
        'codice_fiscale',
        'codice_sdi',
        'pec',
        'indirizzo',
        'cap',
        'localita',
        'provincia',
        'telefono',
        'email',
        'indirizzo_dm',
        'cap_dm',
        'localita_dm',
        'provincia_dm',
        'paese_dm',
        'id_agente_riferimento',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_agente_riferimento'); // appartiene a
    }
}
