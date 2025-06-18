<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
//    protected $fillable = ['value'];
    public function routes()
    {
        return $this->belongsToMany(Route::class,'route_tag');
    }
}
