<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_product',
        'id_product_type',
        'id_clothing_size_type',
        'id_color',
        'id_clothing_size',
        'id_clothing_number_size',
        'id_shoe_size',
        'stock',
        'date'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product'); // appartiene a
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'id_product_type'); // appartiene a
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'id_color'); // appartiene a
    }

    public function clothingSizeType()
    {
        return $this->belongsTo(ClothingSizeType::class, 'id_clothing_size_type'); // appartiene a
    }

    public function clothingSize()
    {
        return $this->belongsTo(ClothingSize::class, 'id_clothing_size'); // appartiene a
    }

    public function clothingNumberSize()
    {
        return $this->belongsTo(ClothingNumberSize::class, 'id_clothing_number_size'); // appartiene a
    }

    public function shoeSize()
    {
        return $this->belongsTo(ShoeSize::class, 'id_shoe_size'); // appartiene a
    }
}
