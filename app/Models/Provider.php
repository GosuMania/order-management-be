<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
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
        'paese',
        'telefono',
        'email',
        'date'
    ];
}
