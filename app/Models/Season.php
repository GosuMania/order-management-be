<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_season_type',
        'desc_season_type',
        'year',
        'startDate',
        'finalDate'
    ];
}
