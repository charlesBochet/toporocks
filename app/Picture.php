<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    public function getUrlAttribute()
    {
        return Storage::disk('s3')->url($this->picture_path);
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}
