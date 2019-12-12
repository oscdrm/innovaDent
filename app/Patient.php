<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //$patient->addresses
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    //$patient->treatments
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
}
