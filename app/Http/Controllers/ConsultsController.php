<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $patients = Patient::paginate(10);
        return view('patients/patients')->with(compact('patients'));
    }

}
