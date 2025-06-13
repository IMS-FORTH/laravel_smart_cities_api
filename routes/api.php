<?php

use App\Http\Controllers\PointController;
use App\Http\Controllers\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::get('/',function (){
    return 'Hello World';
});
Route::apiResource('routes', RouteController::class)->only(['index','show']);
Route::apiResource('points', PointController::class)->only(['index','show']);
