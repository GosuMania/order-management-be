<?php

namespace App\Http\Controllers;

use App\Models\ClothingChildrenSize;
use App\Http\Controllers\Controller;
use App\Resources\SimplePickList\SimplePickList as SimplePickListResource;
use Illuminate\Http\Request;

class ClothingChildrenSizeController extends Controller
{
    public function getAll()
    {
        return SimplePickListResource::collection(ClothingChildrenSize::orderBy('id', 'ASC')->get());
    }
}
