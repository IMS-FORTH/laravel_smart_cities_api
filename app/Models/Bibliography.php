<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bibliography extends Model
{
//    protected $fillable = ['point_id', 'text'];
    public function point()
    {
        return $this->belongsTo(Point::class);
    }
}
