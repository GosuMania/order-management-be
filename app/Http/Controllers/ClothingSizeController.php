<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Http\Controllers\Controller;
use App\Resources\Size\Size as ClothingSizeResource;
use Illuminate\Http\Request;

class ClothingSizeController extends Controller
{
    public function getAll()
    {
        return ClothingSizeResource::collection(Size::orderBy('id', 'ASC')->get());
    }
}
