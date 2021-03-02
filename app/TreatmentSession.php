<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreatmentSession extends Model
{
    //$treatSession->treatment
    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }
}
