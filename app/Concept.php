<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    //$concept->surgery
    public function surgeries(){
        return $this->belongsToMany(Surgery::class);
    }

    //$concept->treatment
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
}
