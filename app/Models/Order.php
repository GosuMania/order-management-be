<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'desc_user',
        'id_customer',
        'desc_customer',
        'id_order_type',
        'desc_order_type',
        'id_payment_methods',
        'desc_payment_methods',
        'id_season',
        'desc_season',
        'id_delivery',
        'desc_delivery',
        'total_pieces',
        'total_amount',
        'date',
    ];
}
