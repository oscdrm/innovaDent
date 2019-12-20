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
        
            return view('cashier/home')->with(compact('consults', 'amountWeek'));
        }

        if(Auth::user()->role_id == 3){
            return 'hola soy un doctor';
        }

    }

    private function consultasCajera($user){
        $consults10 = Consult::where('cashier_id', '=', $user)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(10);
        $allConsults = Consult::where('cashier_id', '=', $user)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $amountWeek = 0;
        foreach($allConsults as $consult){
            $amountWeek = $amountWeek + $consult->amount;
        }
        $consultsArray = ['consults' => $consults10, 'amountWeek' => $amountWeek];
        return $consultsArray;
    }

}
