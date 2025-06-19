<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Route;
use Illuminate\Http\JsonResponse;
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

    public function nearby(Request $request): JsonResponse
    {
        $lat = $request->query('lat');
        $lng = $request->query('lng');
        $radius = $request->query('radius', 1000); // meters default

        if (!$lat || !$lng) {
            return response()->json([
                'error' => 'Missing lat or lng parameters'
            ], 400);
        }
        $points = Point::whereRaw(
            "ST_DWithin(location::geography, ST_MakePoint(?, ?)::geography, ?)",
            [$lng, $lat, $radius]
        )
            ->with('route')
            ->get();
        return response()->json([
            'points' => $points->map(function ($point) {
                return [
                    'id' => $point->id,
                    'name' => $point->name,
                    'lat' => $point->location_lat,
                    'lng' => $point->location_lng,
                    'description' => $point->description,
                    'route' => $point->route, // full route object
                ];
            }),
        ]);
    }
    public function geojsonCollection(): JsonResponse
    {
        $points = Point::all();
        $features = collect($points)->map(function ($point) {
            return [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [(float) $point->getLngAttribute(), (float) $point->getLatAttribute()],
                ],
                'properties' => [
                    'id' => $point->id,
                    'name' => $point->name,
                    'description' => $point->description,
                    'map_number' => $point->map_number,
                    'route_id' => $point->route_id,
                ],
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features,
        ])->header('Content-Type', 'application/geo+json');
    }

    public function geojson($id): JsonResponse
    {
        $point = Point::findOrFail($id);
        $lng = $point->getLngAttribute();
        $lat = $point->getLatAttribute();

        return response()->json([
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [(float) $lng, (float) $lat]
            ],
            'properties' => [
                'id' => $point->id,
                'name' => $point->name,
                'description' => $point->description,
                'map_number' => $point->map_number,
                'route_id' => $point->route_id
            ]
        ])->header('Content-Type', 'application/geo+json');
    }

//    public function nearby(Request $request)
//    {
//        $lat = $request->query('lat');
//        $lng = $request->query('lng');
//        $radius = $request->query('radius', 1000); // meters default
//
//        if (!$lat || !$lng) {
//            return response()->json([
//                'error' => 'Missing lat or lng parameters'
//            ], 400);
//        }
//
//        // Raw spatial query
//        $points = DB::select("
//            SELECT id, name, map_number, description,
//                   ST_Y(location) as lat,
//                   ST_X(location) as lng,
//                   ST_DistanceSphere(location, ST_MakePoint(?, ?)) as distance
//            FROM points
//            WHERE ST_DWithin(location::geography, ST_MakePoint(?, ?)::geography, ?)
//            ORDER BY distance ASC
//        ", [$lng, $lat, $lng, $lat, $radius]);
//
//        return response()->json($points);
//    }


}
