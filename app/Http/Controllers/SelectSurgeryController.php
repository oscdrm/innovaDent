<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Surgery;

class SelectSurgeryController extends Controller
{
    public function selectSurgery($surgery){
        $surgeryObj = Surgery::find($surgery);
        Session::put('surgery', $surgeryObj->id);
        Session::put('surgeryName', $surgeryObj->name);

        return back();
    }
}
