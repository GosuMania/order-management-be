<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'immagine',
        'fornitore',
        'codice_articolo',
        'descrizione_articolo',
        'prezzo',
        'date'
    ];
}
