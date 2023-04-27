<?php

namespace App\Http\Controllers;

use App\Models\ClothingSize;
use App\Http\Controllers\Controller;
use App\Resources\SimplePickList\SimplePickList as SimplePickListResource;
use Illuminate\Http\Request;

class ClothingSizeController extends Controller
{
    public function getAll()
    {
        return SimplePickListResource::collection(ClothingSize::orderBy('id', 'ASC')->get());
    }
}
