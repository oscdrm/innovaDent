<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //$address->patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    //$address->user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
