<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_provider',
        'desc_provider',
        'id_product_type',
        'desc_product_type',
        'id_clothing_size_type',
        'immagine',
        'codice_articolo',
        'descrizione_articolo',
        'prezzo',
        'date'
    ];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'id_product', 'id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'id_provider'); // appartiene a
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'id_product_type'); // appartiene a
    }

    public function clothingSizeType()
    {
        return $this->belongsTo(ClothingSizeType::class, 'id_clothing_size_type'); // appartiene a
    }
}
