<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Point::with('bibliographies')->get();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Point::with('bibliographies')->findOrFail($id);
    }

    public function nearby(Request $request)
    {
        $lat = $request->query('lat');
        $lng = $request->query('lng');
        $radius = $request->query('radius', 1000); // meters default

        if (!$lat || !$lng) {
            return response()->json([
                'error' => 'Missing lat or lng parameters'
            ], 400);
        }

        // Raw spatial query
        $points = DB::select("
            SELECT id, name, map_number, description,
                   ST_Y(location) as lat,
                   ST_X(location) as lng,
                   ST_DistanceSphere(location, ST_MakePoint(?, ?)) as distance
            FROM points
            WHERE ST_DWithin(location::geography, ST_MakePoint(?, ?)::geography, ?)
            ORDER BY distance ASC
        ", [$lng, $lat, $lng, $lat, $radius]);

        return response()->json($points);
    }

}
