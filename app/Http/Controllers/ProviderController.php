<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function getAll()
    {
        return ColorResource::collection(Color::orderBy('id', 'ASC')->get());
    }
}
