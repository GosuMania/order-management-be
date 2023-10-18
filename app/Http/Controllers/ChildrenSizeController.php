<?php

namespace App\Http\Controllers;

use App\Models\ChildrenSize;
use App\Http\Controllers\Controller;
use App\Resources\SimplePickList\SimplePickList as SimplePickListResource;
use Illuminate\Http\Request;

class ChildrenSizeController extends Controller
{
    public function getAll()
    {
        return SimplePickListResource::collection(ChildrenSize::orderBy('id', 'ASC')->get());
    }
}
