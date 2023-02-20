<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'immagine',
        'fornitore',
        'codice_articolo',
        'descrizione_articolo',
        'taglia',
        'id_colore',
        'prezzo',
        'quantita_magazzino',
        'quantita_disponibile',
        'date'
    ];

    public function color()
    {
        return $this->belongsTo(Color::class, 'id_color'); // appartiene a
    }
}
