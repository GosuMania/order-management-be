<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Resources\ProductType\ProductType as ProductTypeResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function getAll()
    {
        return ProductTypeResource::collection(ProductType::orderBy('id', 'ASC')->get());
    }
}
