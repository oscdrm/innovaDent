<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //$role->users
    public function users()
    {
        return $this->hasMany(User::class);
        //return $this->belongsToMany(User::class)->withTimestamps();
    }
}
