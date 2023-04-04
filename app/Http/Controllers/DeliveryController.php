<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Http\Controllers\Controller;
use App\Resources\SimplePickList\SimplePickList as SimplePickListResource;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function getAll()
    {
        return SimplePickListResource::collection(Delivery::orderBy('id', 'ASC')->get());
    }
}
