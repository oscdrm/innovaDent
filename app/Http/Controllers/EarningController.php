<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consult;
use App\Patient;
use App\User;
use App\Concept;
use Carbon\Carbon;
use Auth;

class EarningController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $sendConsults = "";
        $consults = [];
        $amountWeek = 0;
        $doctors = User::where('role_id', '=', 3)->get();
        $concepts = Concept::all();
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $consults = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $allConsults = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $amountWeek = 0;
        $dt = Carbon::now();
        $dt = explode(" ", $dt);
        $dc = "";
        $amountToday = 0;
        $serviciosRealizados = 0;
        $dineroCaja = 0;
        
        
        foreach($allConsults as $consult){
            $dc = $consult->created_at;
            $dc = explode(" ", $dc);
            $paymentMethod = $consult->paymentMethod ? $consult->paymentMethod->id : 0;

            if($consult->dismount != true){
                $serviciosRealizados++;
                $amountWeek = $amountWeek + $consult->amount;

                if($paymentMethod == 1){
                    $dineroCaja = $dineroCaja + $consult->amount;
                }

                if($dt[0] == $dc[0]){
                    $amountToday = $amountToday + $consult->amount;
                }
            }else{
                $amountWeek = $amountWeek - $consult->amount;
                if($dt[0] == $dc[0]){
                    $amountToday = $amountToday - $consult->amount;
                }
            }
        }
    
        return view('earns/earns')->with(compact('sendConsults', 'consults', 'amountWeek', 'serviciosRealizados', 'doctors', 'concepts'));
    }

    public function calculate(Request $request){

        $consults = [];
        $amountWeek = 0;
        $doctors = User::where('role_id', '=', 3)->get();
        $doctor = $request->input('doctor');
        $concept = $request->input('concept');
        $concepts = Concept::all();
        $start = $request->input('start');
        $end = $request->input('end');
        Carbon::setLocale('es');
        $arrayClausules = [];
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $consults = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        
        if($doctor){
            $doctorData = User::find($doctor);
            array_push($arrayClausules, ['doctor_id', '=', $doctor]);
            $sendConsults = "recientes del doctor ".$doctorData->name." ".$doctorData->lastName;
            $consults = Consult::where($arrayClausules)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            if($start && $end){
                $ds = Carbon::createFromFormat('d/m/Y', $start)->startOfDay();
                $de = Carbon::createFromFormat('d/m/Y', $end)->endOfDay();
                //$ds = $ds->toDateString();
                //$de = $de->toDateString();
                $consults = Consult::where($arrayClausules)->whereBetween('created_at', [$ds, $de])->get();
            }
        }

        if($concept){
            array_push($arrayClausules, ['concept_id', '=', $concept]);
            $consults = Consult::where($arrayClausules)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            if($start && $end){
                $ds = Carbon::createFromFormat('d/m/Y', $start)->startOfDay();
                $de = Carbon::createFromFormat('d/m/Y', $end)->endOfDay();
                //$ds = $ds->toDateString();
                //$de = $de->toDateString();
                $consults = Consult::where($arrayClausules)->whereBetween('created_at', [$ds, $de])->get();
            }
        }
    
        $amountWeek = 0;
        $dineroCaja = 0;
        $dt = Carbon::now();
        $dt = explode(" ", $dt);
        $dc = "";
        $amountToday = 0;
        $serviciosRealizados = 0;
        foreach($consults as $consult){
            $dc = $consult->created_at;
            $dc = explode(" ", $dc);
            $paymentMethod = $consult->paymentMethod ? $consult->paymentMethod->id : 0;
            if($consult->dismount != true){
                $serviciosRealizados++;
                    $amountWeek = $amountWeek + $consult->amount;
                    if($paymentMethod == 1){
                        $dineroCaja = $dineroCaja + $consult->amount;
                    }
                    if($dt[0] == $dc[0]){
                        $amountToday = $amountToday + $consult->amount;
                    }
            }else{
                $amountWeek = $amountWeek - $consult->amount;
                if($dt[0] == $dc[0]){
                    $amountToday = $amountToday - $consult->amount;
                }
            }
        }
        
        return view('earns/earns')->with(compact('sendConsults', 'consults', 'amountWeek', 'serviciosRealizados', 'doctors', 'concepts', 'dineroCaja'));


    }

}
