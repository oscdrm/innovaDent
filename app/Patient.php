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
        return $this->hasMany(Treatment::class)->orderBy('created_at', 'DESC');
    }

    //$patient->clinicHistories
    public function clinicHistories()
    {
        return $this->hasMany(ClinicHistory::class)->orderBy('created_at', 'DESC');
    }

    public function consults()
    {
        return $this->hasMany(Consult::class)->orderBy('created_at', 'DESC');
    }

}
