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
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $consults = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(10);
        $allConsults = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $amountWeek = 0;
        $dt = Carbon::now();
        $dt = explode(" ", $dt);
        $dc = "";
        $amountToday = 0;
        $serviciosRealizados = 0;
        foreach($allConsults as $consult){
            $serviciosRealizados++;
            $amountWeek = $amountWeek + $consult->amount;
            $dc = $consult->created_at;
            $dc = explode(" ", $dc);
            if($dt[0] == $dc[0]){
                $amountToday = $amountToday + $consult->amount;
            }
        }
    
        return view('earns/earns')->with(compact('sendConsults', 'consults', 'amountWeek', 'serviciosRealizados', 'doctors'));
    }

    public function calculate(Request $request){

        $consults = [];
        $amountWeek = 0;
        $doctors = User::where('role_id', '=', 3)->get();
        $doctor = $request->input('doctor');
        $start = $request->input('start');
        $end = $request->input('end');
        Carbon::setLocale('es');
        
        
        if($doctor){
            $doctorData = User::find($doctor);
            $sendConsults = "recientes del doctor ".$doctorData->name." ".$doctorData->lastName;
            $consults = Consult::where('doctor_id', '=', $doctor)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            if($start && $end){
                $ds = Carbon::createFromFormat('d/m/Y', $start)->startOfDay();
                $de = Carbon::createFromFormat('d/m/Y', $end)->endOfDay();
                //$ds = $ds->toDateString();
                //$de = $de->toDateString();
    
                $consults = Consult::where('doctor_id', '=', $doctor)->whereBetween('created_at', [$ds, $de])->get();
            }
        }else{
            $sendConsults = "recientes";

            if($start && $end){
                $ds = Carbon::createFromFormat('d/m/Y', $start)->startOfDay();
                $de = Carbon::createFromFormat('d/m/Y', $end)->endOfDay();
                $ds2 = $ds->format('l d, F Y');
                $de2 = $de->format('l d, F Y');
                //$ds2 = $ds2->toFormattedDateString(); 
                //$de2 = $de2->toFormattedDateString(); 
                $sendConsults = "del $ds2 al $de2";
               
    
                $consults = Consult::whereBetween('created_at', [$ds, $de])->get();
            }

        }

        
              


        $amountWeek = 0;
        $dt = Carbon::now();
        $dt = explode(" ", $dt);
        $dc = "";
        $amountToday = 0;
        $serviciosRealizados = 0;
        foreach($consults as $consult){
            $serviciosRealizados++;
            $amountWeek = $amountWeek + $consult->amount;
            $dc = $consult->created_at;
            $dc = explode(" ", $dc);
            if($dt[0] == $dc[0]){
                $amountToday = $amountToday + $consult->amount;
            }
        }
        
        return view('earns/earns')->with(compact('sendConsults', 'consults', 'amountWeek', 'serviciosRealizados', 'doctors'));


    }

}
