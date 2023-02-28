<?php

namespace App\Http\Controllers;

use App\Models\ShoeSize;
use App\Http\Controllers\Controller;
use App\Resources\ShoeSize\ShoeSize as ShoeSizeResource;
use Illuminate\Http\Request;

class ShoeSizeController extends Controller
{
    public function getAll()
    {
        return ShoeSizeResource::collection(ShoeSize::orderBy('id', 'ASC')->get());
    }
}
