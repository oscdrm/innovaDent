<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicHistory extends Model
{
    //$clinicHistory->patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    //$clinicHistory->treatment
    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }

}
