<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Route;
use Illuminate\Http\Request;


class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Route::with('tags','points')->get();

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Route::with('tags','points.bibliographies')->findOrFail($id);
    }


//    public function nearPoints($lat, $lng, $rad)
//    {
//        // Convert to float (security handled by route regex)
//        $latitude = (float)$lat;
//        $longitude = (float)$lng;
//        $radiusMeters = (float)$rad * 1000;
//
//        // Validate ranges
//        if ($latitude < -90 || $latitude > 90 || $longitude < -180 || $longitude > 180) {
//            return response()->json(['error' => 'Invalid coordinates'], 400);
//        }
//
//        $routes = Route::whereHas('points', function($query) use ($longitude, $latitude, $radiusMeters) {
//            $query->whereRaw(
//                "ST_DWithin(
//                location::geography,
//                ST_SetSRID(ST_MakePoint(?, ?), 4326)::geography,
//                ?
//            )",
//                [$longitude, $latitude, $radiusMeters]
//            );
//        })->with(['points' => function($query) use ($longitude, $latitude, $radiusMeters) {
//            $query->whereRaw("ST_DWithin(
//                location::geography,
//                ST_SetSRID(ST_MakePoint(?, ?), 4326)::geography,
//                ?
//            )"); // Same as above
//        }])->get();
//
//        return response()->json($routes);
//    }

}
