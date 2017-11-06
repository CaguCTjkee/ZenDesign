<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function getRouteKeyName()
    {
        return 'alias';
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
