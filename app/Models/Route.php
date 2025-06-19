<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
//    protected $fillable = ['name', 'description'];
    public function points(): HasMany
    {
        return $this->hasMany(Point::class);
    }

    public function tags(): belongsToMany
    {
        return $this->belongsToMany(Tag::class,'route_tag');
    }
}
