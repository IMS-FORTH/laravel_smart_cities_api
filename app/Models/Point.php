<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Point extends Model
{
//    protected $fillable = ['route_id', 'name', 'map_number', 'location', 'description'];
    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    public function bibliographies(): HasMany
    {
        return $this->hasMany(Bibliography::class);
    }

    public function getLatAttribute()
    {
        return DB::table('points')->where('id', $this->id)->value(DB::raw('ST_Y(location)'));
    }

    public function getLngAttribute()
    {
        return DB::table('points')->where('id', $this->id)->value(DB::raw('ST_X(location)'));
    }

}
