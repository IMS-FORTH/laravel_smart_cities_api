<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = ['route_id', 'name', 'map_number', 'location', 'description'];
    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function bibliographies()
    {
        return $this->hasMany(Bibliography::class);
    }
}
