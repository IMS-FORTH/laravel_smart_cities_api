<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;

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


}
