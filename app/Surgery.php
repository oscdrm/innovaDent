<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    //$surgery->concepts
    public function concepts()
    {
        return $this->hasMany(Concept::class);

    }
}
