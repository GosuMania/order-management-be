<?php

namespace App\Http\Controllers;

use App\Models\SeasonType;
use App\Http\Controllers\Controller;
use App\Resources\SeasonType\SeasonType as SeasonTypeResource;
use Illuminate\Http\Request;

class SeasonTypeController extends Controller
{
    public function getAll()
    {
        return SeasonTypeResource::collection(SeasonType::orderBy('id', 'ASC')->get());
    }
}
