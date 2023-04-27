<?php

namespace App\Http\Controllers;

use App\Models\ClothingNumberSize;
use App\Resources\SimplePickList\SimplePickList as SimplePickListResource;
use Illuminate\Http\Request;

class ClothingNumberSizeController extends Controller
{
    public function getAll()
    {
        return SimplePickListResource::collection(ClothingNumberSize::orderBy('id', 'ASC')->get());
    }
}
