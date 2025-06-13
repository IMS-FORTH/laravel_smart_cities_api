<?php

namespace App\Http\Controllers;

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

}
