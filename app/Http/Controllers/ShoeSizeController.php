<?php

namespace App\Http\Controllers;

use App\Models\ShoeSize;
use App\Http\Controllers\Controller;
use App\Resources\SimplePickList\SimplePickList as SimplePickListResource;
use Illuminate\Http\Request;

class ShoeSizeController extends Controller
{
    public function getAll()
    {
        return SimplePickListResource::collection(ShoeSize::orderBy('id', 'ASC')->get());
    }
}
