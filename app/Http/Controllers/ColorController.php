<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Http\Controllers\Controller;
use App\Resources\Color\Color as ColorResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ColorController extends Controller
{

    public function getAll()
    {
        return ColorResource::collection(Color::orderBy('id', 'ASC')->get());
    }
}
