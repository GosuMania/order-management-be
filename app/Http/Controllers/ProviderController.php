<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Resources\Provider\ProductType as ProviderResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function getAll()
    {
        return ProviderResource::collection(Provider::orderBy('id', 'ASC')->get());
    }
}
