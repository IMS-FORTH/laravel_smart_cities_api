<?php

use App\Http\Controllers\PointController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TagController;
use App\Models\Point;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

//Route::get('/',function (){
//    return 'Hello World';
//});
Route::get('points/nearby',[PointController::class,'nearby']);
Route::get('/routes/nearby', [RouteController::class, 'nearby']);
Route::get('/points/geojson', [PointController::class, 'geojsonCollection']);
Route::apiResource('routes', RouteController::class)->only(['index','show']);
Route::apiResource('points', PointController::class)->only(['index', 'show']);
Route::apiResource('tags', TagController::class)->only(['index', 'show']);
Route::get('/routes/{id}/points', function ($id) {
    return Point::where('route_id', $id)->get();
});
Route::get('/routes/{id}/tags', function ($id) {
    return \App\Models\Route::findOrFail($id)->tags;
});


Route::get('/points/{id}/geojson', [PointController::class, 'geojson']);

