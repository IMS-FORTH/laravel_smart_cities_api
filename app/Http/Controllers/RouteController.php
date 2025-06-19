<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

    public function nearby(Request $request)
    {
        $lat = $request->query('lat');
        $lng = $request->query('lng');
        $radius = $request->query('radius', 1000); // default in meters

        if (!$lat || !$lng) {
            return response()->json([
                'error' => 'Missing lat or lng parameters'
            ], 400);
        }

        // Step 1: Find route_ids of points within the given radius
        $routeIds = DB::table('points')
            ->select('route_id')
            ->whereRaw("ST_DWithin(location::geography, ST_MakePoint(?, ?)::geography, ?)", [$lng, $lat, $radius])
            ->distinct()
            ->pluck('route_id');

        // Step 2: Fetch routes that match these IDs
        $routes = DB::table('routes')
            ->whereIn('id', $routeIds)
            ->get();

        return response()->json([
            'routes' => $routes
        ]);
    }



}
