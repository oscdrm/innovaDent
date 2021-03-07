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
        if(Auth::user()->role_id == 1){
            $consults = $this->consultasAdmin();
            $ncw = $consults['nconsultsweek'];
            $nct = $consults['nct'];
            $ncm = $consults['ncm'];
            $amountWeek = $consults['amountWeek'];
            $amountToday = $consults['amountToday'];
            $consults = $consults['consults'];
            return view('home')->with(compact('ncw', 'nct', 'ncm', 'amountWeek', 'amountToday', 'consults'));
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
            return 'hola soy un doctor';
        }

    }

    public function cash(){

        if(Auth::user()->role_id == 2){

            $user = Auth::user()->id;
            $consults = $this->consultasCajera($user);
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

    private function consultasAdmin(){
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        
        $nconsultsweek = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('outflow', '!=', true)->count();
        $nct = Consult::whereDate('created_at', Carbon::today())->where('outflow', '!=', true)->count();
        $ncm = Consult::whereMonth('created_at', Carbon::now()->month)->where('outflow', '!=', true)->count();
        $consults10 = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $allConsults = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        if (session()->has('surgery')) {
            $surgery = Session::get('surgery');
            $nconsultsweek = Consult::where('surgery_id', '=', $surgery)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('outflow', '!=', true)->count();
            $nct = Consult::where('surgery_id', '=', $surgery)->whereDate('created_at', Carbon::today())->where('outflow', '!=', true)->count();
            $ncm = Consult::where('surgery_id', '=', $surgery)->whereMonth('created_at', Carbon::now()->month)->where('outflow', '!=', true)->count();
            $consults10 = Consult::where('surgery_id', '=', $surgery)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            $allConsults = Consult::where('surgery_id', '=', $surgery)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();  
        }

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
         
     

        $consultsArray = ['nconsultsweek' => $nconsultsweek, 'nct' => $nct, 'ncm' => $ncm, 'consults' => $consults10, 'amountWeek' => $amountWeek, 'amountToday' => $amountToday];
        
        return $consultsArray;
    }


}
