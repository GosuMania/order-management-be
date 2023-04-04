<?php

namespace App\Http\Controllers;

use App\Models\SeasonType;
use App\Http\Controllers\Controller;
use App\Resources\SimplePickList\SimplePickList as SimplePickListResource;
use Illuminate\Http\Request;

class SeasonTypeController extends Controller
{
    public function getAll()
    {
        return SimplePickListResource::collection(SeasonType::orderBy('id', 'ASC')->get());
    }
}
