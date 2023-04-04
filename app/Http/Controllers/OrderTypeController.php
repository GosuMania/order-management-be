<?php

namespace App\Http\Controllers;

use App\Models\OrderType;
use App\Http\Controllers\Controller;
use App\Resources\SimplePickList\SimplePickList as SimplePickListResource;
use Illuminate\Http\Request;

class OrderTypeController extends Controller
{
    public function getAll()
    {
        return SimplePickListResource::collection(OrderType::orderBy('id', 'ASC')->get());
    }
}
