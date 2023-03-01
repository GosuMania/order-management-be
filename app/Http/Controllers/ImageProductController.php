<?php

namespace App\Http\Controllers;

use App\Models\ImageProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ImageProductController extends Controller
{
    public function upload(Request $request)
    {
        if (!$request->hasFile('image') && !$request->file('image')->isValid()) {
            return response()->json(['error' => 'Perfavore inserisci un immagine.'], 401);
        } else {
            try {
                $image = $request->file('image');
                $path = $image->storePubliclyAs(
                    '', Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension(), 'images'
                );
                ImageProduct::create([
                    'link' => env('APP_URL') . '/images/' . $path,
                ]);
                return response()->json(env('APP_URL') . '/images/' . $path, 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            } catch (Exception $e) {
                return response()->json($e);
            }
        }

    }
}
