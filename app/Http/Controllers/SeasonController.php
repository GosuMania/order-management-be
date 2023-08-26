<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Http\Controllers\Controller;
use App\Resources\Season\Season as SeasonResource;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function getAll()
    {
        return SeasonResource::collection(Season::orderBy('id', 'ASC')->get());
    }
}
