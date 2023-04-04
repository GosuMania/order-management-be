<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethods;
use App\Http\Controllers\Controller;
use App\Resources\SimplePickList\SimplePickList as SimplePickListResource;
use Illuminate\Http\Request;

class PaymentMethodsController extends Controller
{
    public function getAll()
    {
        return SimplePickListResource::collection(PaymentMethods::orderBy('id', 'ASC')->get());
    }
}
