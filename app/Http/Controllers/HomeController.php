<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Consult;
use Carbon\Carbon;
use Session;

class HomeController extends Controller
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
        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4){
            $consults = $this->consultasAdmin();
            $ncw = $consults['nconsultsweek'];
            $nct = $consults['nct'];
            $ncm = $consults['ncm'];
            $amountWeekHuetamo = $consults['amountWeekHuetamo'];
            $amountTodayHuetamo = $consults['amountTodayHuetamo'];
            $amountWeekMaravatio = $consults['amountWeekMaravatio'];
            $amountTodayMaravatio = $consults['amountTodayMaravatio'];
            $amountWeekParacho = $consults['amountWeekParacho'];
            $consults = $consults['consults'];
            return view('home')->with(compact('ncw', 'nct', 'ncm', 'amountWeekHuetamo', 'amountTodayHuetamo', 'consults', 'amountWeekMaravatio', 'amountTodayMaravatio', 'amountWeekParacho'));
        }

        if(Auth::user()->role_id == 2){

            $user = Auth::user()->id;
            $consults = $this->consultasCajera($user);
            $amountWeek = $consults['amountWeek'];
            $amountToday = $consults['amountToday'];
            $consults = $consults['consults'];
            return view('cashier/home')->with(compact('consults', 'amountWeek', 'amountToday'));
        }

        if(Auth::user()->role_id == 3){
            $user = Auth::user()->id;
            $consults = $this->consultasCajera($user);
            $amountWeek = $consults['amountWeek'];
            $amountToday = $consults['amountToday'];
            $consults = $consults['consults'];
            return view('doctor/home')->with(compact('ncw', 'nct', 'ncm', 'consults', 'amountWeek', 'amountToday'));
        }

    }

    public function cash(){

        if(Auth::user()->role_id == 2){

            $user = Auth::user()->id;
            $consults = $this->consultasDoctor($user);
            $amountWeek = $consults['amountWeek'];
            $amountToday = $consults['amountToday'];
            $consults = $consults['consults'];

            return view('cashier/cash')->with(compact('consults', 'amountWeek', 'amountToday'));
        }


    }

    private function consultasCajera($user){
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $consults = Consult::where('cashier_id', '=', $user)
                    ->whereDate('created_at', Carbon::today())
                    //->where('outflow', '!=', true)
                    ->orderBy('created_at', 'desc')->get();
        $allConsults = Consult::where('cashier_id', '=', $user)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $amountWeek = 0;
        $dt = Carbon::now();
        $dt = explode(" ", $dt);
        $dc = "";
        $amountToday = 0;
        foreach($allConsults as $consult){
            if($consult->dismount != true){
                $amountWeek = $amountWeek + $consult->amount;
                $dc = $consult->created_at;
                $dc = explode(" ", $dc);
                if($dt[0] == $dc[0]){
                    $amountToday = $amountToday + $consult->amount;
                }
            }else{
                $amountWeek = $amountWeek - $consult->amount;
                $dc = $consult->created_at;
                $dc = explode(" ", $dc);
                if($dt[0] == $dc[0]){
                    $amountToday = $amountToday - $consult->amount;
                }
            }
            
        }

        $consultsArray = ['consults' => $consults, 'amountWeek' => $amountWeek, 'amountToday' => $amountToday];
        
        return $consultsArray;
    }

    private function consultasDoctor($user){
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $consults = Consult::where('doctor_id', '=', $user)
                    ->whereDate('created_at', Carbon::today())
                    //->where('outflow', '!=', true)
                    ->orderBy('created_at', 'desc')->get();
        $allConsults = Consult::where('doctor_id', '=', $user)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $nconsultsweek = Consult::where('doctor_id', '=', $user)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('outflow', '!=', true)->count();
        $nct = Consult::where('doctor_id', '=', $user)->whereDate('created_at', Carbon::today())->where('outflow', '!=', true)->count();
        $ncm = Consult::where('doctor_id', '=', $user)->whereMonth('created_at', Carbon::now()->month)->where('outflow', '!=', true)->count();
        $amountWeek = 0;
        $dt = Carbon::now();
        $dt = explode(" ", $dt);
        $dc = "";
        $amountToday = 0;
        foreach($allConsults as $consult){
            if($consult->dismount != true){
                $amountWeek = $amountWeek + $consult->amount;
                $dc = $consult->created_at;
                $dc = explode(" ", $dc);
                if($dt[0] == $dc[0]){
                    $amountToday = $amountToday + $consult->amount;
                }
            }else{
                $amountWeek = $amountWeek - $consult->amount;
                $dc = $consult->created_at;
                $dc = explode(" ", $dc);
                if($dt[0] == $dc[0]){
                    $amountToday = $amountToday - $consult->amount;
                }
            }
            
        }

        $consultsArray = ['nconsultsweek' => $nconsultsweek, 'nct' => $nct, 'ncm' => $ncm, 'consults' => $consults, 'amountWeek' => $amountWeek, 'amountToday' => $amountToday];
        
        return $consultsArray;
    }

    private function consultasAdmin(){
        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);

        
        $nconsultsweek = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('outflow', '!=', true)->count();
        $nct = Consult::whereDate('created_at', Carbon::today())->where('outflow', '!=', true)->count();
        $ncm = Consult::whereMonth('created_at', Carbon::now()->month)->where('outflow', '!=', true)->count();
        $consults10 = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $allConsultsHuetamo = Consult::where('surgery_id', '=', 1)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $allConsultsMaravatio = Consult::where('surgery_id', '=', 2)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $allConsultsParacho = Consult::where('surgery_id', '=', 4)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $allConsultsAltamirano = Consult::where('surgery_id', '=', 5)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        

        if (session()->has('surgery')) {
            $surgery = Session::get('surgery');
            $nconsultsweek = Consult::where('surgery_id', '=', $surgery)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('outflow', '!=', true)->count();
            $nct = Consult::where('surgery_id', '=', $surgery)->whereDate('created_at', Carbon::today())->where('outflow', '!=', true)->count();
            $ncm = Consult::where('surgery_id', '=', $surgery)->whereMonth('created_at', Carbon::now()->month)->where('outflow', '!=', true)->count();
            $consults10 = Consult::where('surgery_id', '=', $surgery)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            //$allConsults = Consult::where('surgery_id', '=', $surgery)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();  
        }

        $amountWeekHuetamo = 0;
        $amountWeekMaravatio = 0;
        $amountWeekParacho = 0;
        $amountWeekAltamirano = 0;
        $dt = Carbon::now();
        $dt = explode(" ", $dt);
        $dc = "";
        $amountTodayHuetamo = 0;
        $amountTodayMaravatio = 0;
        foreach($allConsultsHuetamo as $consulth){
            if($consulth->dismount != true){
                $amountWeekHuetamo = $amountWeekHuetamo + $consulth->amount;
                $dc = $consulth->created_at;
                $dc = explode(" ", $dc);
                if($dt[0] == $dc[0]){
                    $amountTodayHuetamo = $amountTodayHuetamo + $consulth->amount;
                }
            }else{
                $amountWeekHuetamo = $amountWeekHuetamo - $consulth->amount;
                $dc = $consulth->created_at;
                $dc = explode(" ", $dc);
                if($dt[0] == $dc[0]){
                    $amountTodayHuetamo = $amountTodayHuetamo - $consulth->amount;
                }
            }
            
        }

        foreach($allConsultsMaravatio as $consult){
            if($consult->dismount != true){
                $amountWeekMaravatio = $amountWeekMaravatio + $consult->amount;
                $dc = $consult->created_at;
                $dc = explode(" ", $dc);
                if($dt[0] == $dc[0]){
                    $amountTodayMaravatio = $amountTodayMaravatio + $consult->amount;
                }
            }else{
                $amountWeekMaravatio = $amountWeekMaravatio - $consult->amount;
                $dc = $consult->created_at;
                $dc = explode(" ", $dc);
                if($dt[0] == $dc[0]){
                    $amountTodayMaravatio = $amountTodayMaravatio - $consult->amount;
                }
            }
            
        }

        foreach($allConsultsParacho as $consultPar){
            if($consultPar->dismount != true){
                $amountWeekParacho = $amountWeekParacho + $consultPar->amount;
                $dc = $consultPar->created_at;
                $dc = explode(" ", $dc);
                if($dt[0] == $dc[0]){
                    //$amountTodayMaravatio = $amountTodayMaravatio + $consultPar->amount;
                }
            }else{
                $amountWeekParacho = $amountWeekParacho - $consultPar->amount;
                $dc = $consultPar->created_at;
                $dc = explode(" ", $dc);
                if($dt[0] == $dc[0]){
                    //$amountTodayMaravatio = $amountTodayMaravatio - $consultPar->amount;
                }
            }
            
        }


        foreach($allConsultsAltamirano as $consultAlta){
            if($consultAlta->dismount != true){
                $amountWeekAltamirano = $amountWeekAltamirano + $consultAlta->amount;
                $dc = $consultAlta->created_at;
                $dc = explode(" ", $dc);
                if($dt[0] == $dc[0]){
                    //$amountTodayMaravatio = $amountTodayMaravatio + $consultAlta->amount;
                }
            }else{
                $amountWeekAltamirano = $amountWeekAltamirano - $consultAlta->amount;
                $dc = $consultAlta->created_at;
                $dc = explode(" ", $dc);
                if($dt[0] == $dc[0]){
                    //$amountTodayMaravatio = $amountTodayMaravatio - $consultAlta->amount;
                }
            }
            
        }
         
     

        $consultsArray = ['nconsultsweek' => $nconsultsweek,
                          'nct' => $nct,
                          'ncm' => $ncm,
                          'consults' => $consults10,
                          'amountWeekHuetamo' => $amountWeekHuetamo,
                          'amountTodayHuetamo' => $amountTodayHuetamo,
                          'amountWeekMaravatio' => $amountWeekMaravatio,
                          'amountTodayMaravatio' => $amountTodayMaravatio,
                          'amountWeekParacho' => $amountWeekParacho,
                          'amountWeekAltamirano' => $amountWeekAltamirano
                        ];
        
        return $consultsArray;
    }


}
