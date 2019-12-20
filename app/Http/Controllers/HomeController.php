<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Consult;
use Carbon\Carbon;

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
            return view('home');
        }

        if(Auth::user()->role_id == 2){

            $user = Auth::user()->id;
            $consults = $this->consultasCajera($user);
            $amountWeek = $consults['amountWeek'];
            $consults = $consults['consults'];
            $amountToday = $consults['amountToday'];
        
            return view('cashier/home')->with(compact('consults', 'amountWeek', 'amountToday'));
        }

        if(Auth::user()->role_id == 3){
            return 'hola soy un doctor';
        }

    }

    private function consultasCajera($user){
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $consults10 = Consult::where('cashier_id', '=', $user)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(10);
        $allConsults = Consult::where('cashier_id', '=', $user)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $amountWeek = 0;
        $dt = Carbon::now();
        $dt = explode(" ", $dt);
        $dc = "";
        $amountToday = 0;
        foreach($allConsults as $consult){
            $amountWeek = $amountWeek + $consult->amount;
            $dc = $consult->created_at;
            $dc = explode(" ", $dc);
            if($dt[0] == $dc[0]){
                $amountToday = $amountToday + $consult->amount;
            }
        }
        $consultsArray = ['consults' => $consults10, 'amountWeek' => $amountWeek, 'amountToday' => $amountToday];
        return $consultsArray;
    }

}
