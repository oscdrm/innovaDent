<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function concepts(){
        return $this->belongsToMany(Concept::class);
    }

}
