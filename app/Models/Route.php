<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['name', 'description'];
    public function points()
    {
        return $this->hasMany(Point::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'route_tag');
    }
}
