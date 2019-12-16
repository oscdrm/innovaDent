<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    //$treatment->patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    //$treatment->concept
    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    //$treatment->doctor
    public function doctor()
    {
        return $this->belongsTo('App\User', 'doctor_id');
    }

    //$treatment->numSessions
    public function numSessions()
    {
        return $this->hasMany(TreatmentSession::class);
    }

    //$treatment->clinicHistories
    public function clinicHistories()
    {
        return $this->hasMany(ClinicHistory::class);
    }

}
