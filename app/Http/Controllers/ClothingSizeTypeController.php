<?php

namespace App\Http\Controllers;

use App\Models\ClothingSizeType;
use App\Http\Controllers\Controller;
use App\Resources\SimplePickList\SimplePickList as SimplePickListResource;
use Illuminate\Http\Request;

class ClothingSizeTypeController extends Controller
{
    public function getAll()
    {
        return SimplePickListResource::collection(ClothingSizeType::orderBy('id', 'ASC')->get());
    }
}
