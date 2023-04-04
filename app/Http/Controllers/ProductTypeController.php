<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Resources\SimplePickList\SimplePickList as SimplePickListResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function getAll()
    {
        return SimplePickListResource::collection(ProductType::orderBy('id', 'ASC')->get());
    }
}
