<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consult;
use App\Patient;
use App\User;
use App\Concept;
use Carbon\Carbon;
use Auth;
use Session;

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
        $doctors = User::where('role_id', '=', 3)->orWhere('username', 'admin')->get();
        $concepts = Concept::all();
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $consults = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $allConsults = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        if (session()->has('surgery')) {
            $surgery = Session::get('surgery');
            $surgeries = [$surgery];
            $doctors = User::where('surgery_id', '=', $surgery)->where('role_id', '=', 3)->orWhere('username', 'admin')->get();
            $concepts = Concept::whereHas('surgeries', function($q) use($surgeries) {
                $q->whereIn('surgery_id', $surgeries);
            })->get();
            $consults = Consult::where('surgery_id', '=', $surgeries)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            $allConsults = Consult::where('surgery_id', '=', $surgeries)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        }

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
                if($paymentMethod == 1){
                    $dineroCaja = $dineroCaja - $consult->amount;
                }
                if($dt[0] == $dc[0]){
                    $amountToday = $amountToday - $consult->amount;
                }
            }
        }
    
        return view('earns/earns')->with(compact('sendConsults', 'consults', 'amountWeek', 'serviciosRealizados', 'doctors', 'concepts', 'dineroCaja'));
    }

    public function calculate(Request $request){
        $sendConsults = "";
        $consults = [];
        $amountWeek = 0;
        $doctors = User::where('role_id', '=', 3)->orWhere('username', 'admin')->get();
        $doc = $request->input('doctor');
        $conc = $request->input('concept');
        $concepts = Concept::all();
        $start = $request->input('start');
        $end = $request->input('end');
        $vali = 0;
        Carbon::setLocale('es');
        $arrayClausules = [];
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $consults = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        
        if (session()->has('surgery')) {
            $surgery = Session::get('surgery');
            echo $surgery;
            exit();
            $surgeries = [$surgery];
            $doctors = User::where('surgery_id', '=', $surgery)->where('role_id', '=', 3)->orWhere('username', 'admin')->get();
            $concepts = Concept::whereHas('surgeries', function($q) use($surgeries) {
                $q->whereIn('surgery_id', $surgeries);
            })->get();
            array_push($arrayClausules, ['surgery_id', '=', $surgery]);
            $consults = Consult::where($arrayClausules)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        }

        if($doc){
            $doctorData = User::find($doc);
            array_push($arrayClausules, ['doctor_id', '=', $doc]);
            $sendConsults = "recientes del doctor ".$doctorData->name." ".$doctorData->lastName;
            $consults = Consult::where($arrayClausules)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        }

        if($conc){
            array_push($arrayClausules, ['concept_id', '=', $conc]);
            $consults = Consult::where($arrayClausules)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        }

        if($start && $end){
            $ds = Carbon::createFromFormat('d/m/Y', $start)->startOfDay();
            $de = Carbon::createFromFormat('d/m/Y', $end)->endOfDay();
            //$ds = $ds->toDateString();
            //$de = $de->toDateString();
            $consults = Consult::where($arrayClausules)->whereBetween('created_at', [$ds, $de])->get();
            $vali = 1;
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
                if($paymentMethod == 1){
                    $dineroCaja = $dineroCaja - $consult->amount;
                }
                if($dt[0] == $dc[0]){
                    $amountToday = $amountToday - $consult->amount;
                }
            }
        }
        
        return view('earns/earns')->with(compact('sendConsults', 'consults', 'amountWeek',
                                                 'serviciosRealizados', 'doctors', 'concepts',
                                                 'dineroCaja', 'start', 'end', 'vali', 'doc',
                                                 'conc'));


    }

}
