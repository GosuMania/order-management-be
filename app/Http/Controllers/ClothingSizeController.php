<?php

namespace App\Http\Controllers;

use App\Models\ClothingSize;
use App\Http\Controllers\Controller;
use App\Resources\ClothingSize\ClothingSize as ClothingSizeResource;
use Illuminate\Http\Request;

class ClothingSizeController extends Controller
{
    public function getAll()
    {
        return ClothingSizeResource::collection(ClothingSize::orderBy('id', 'ASC')->get());
    }
}
