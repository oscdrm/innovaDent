<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageClinic extends Model
{
    //$message->ClinicHistory
    public function clinicHistory()
    {
        return $this->belongsTo(ClinicHistory::class);
    }

    //$message->doctor
    public function doctor()
    {
        return $this->belongsTo('App\User', 'doctor_id');
    }
}
