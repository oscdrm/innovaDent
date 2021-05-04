<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    //
     //$payment->consults
     public function consults()
     {
         return $this->hasMany(Consult::class);
     }
}
