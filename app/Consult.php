<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    //$consult->concept
    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    //$consult->doctor
    public function doctor()
    {
        return $this->belongsTo('App\User', 'doctor_id');
    }

    //$consult->cashier
    public function cashier()
    {
        return $this->belongsTo('App\User', 'cashier_id');
    }

    //$consult->patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
