<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consult;
use App\Patient;
use App\User;
use App\Concept;
use App\PaymentMethod;
use App\Surgery;
use Carbon\Carbon;
use Auth;
use DB;
use Session;

class ConsultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $sunday = Carbon::setWeekStartsAt(Carbon::SUNDAY);
        $saturday =  Carbon::setWeekEndsAt(Carbon::SATURDAY);

        if(Auth::user()->role_id == 1){

            $consults = Consult::orderBy('created_at', 'desc')
                      ->paginate();

            if (session()->has('surgery')) {
                $surgery = Session::get('surgery');
                $consults = Consult::where('surgery_id', '=', $surgery)->orderBy('created_at', 'desc')
                      ->paginate();
            }

            
        }

        if(Auth::user()->role_id == 2){
            $user = Auth::user()->id;
            $consults = Consult::where('cashier_id', '=', $user)
                      ->whereBetween('created_at', [Carbon::now()
                      ->startOfWeek(), Carbon::now()->endOfWeek()])
                      ->orderBy('created_at', 'desc')
                      ->paginate();
        }

        return view('consults/consults')->with(compact('consults'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = User::where('role_id', '=', 3)->orWhere('username', 'admin')->get();
        $services = Concept::all();
        if(Auth::user()->role_id != 1){
            $surgery_id = Auth::user()->surgery_id;
            $surgeries = [$surgery_id];
            $services = Concept::whereHas('surgeries', function($q) use($surgeries) {
                $q->whereIn('surgery_id', $surgeries);
            })->get();
        }

        $surgeries = Surgery::all();
        $payments = PaymentMethod::all();
        return view('consults.create')->with(compact('services', 'doctors', 'patients', 'payments', 'surgeries'));

    }

    public function store(Request $request)
    {

        //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'surgery_id.required' => 'Debes de selecionar una tienda',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'digits' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
            'email' => 'Debes ingresar un email valido example@example.com'
        ];

        //Validaciones
        $rules = [
            'doctor' => 'required',
            'concept' => 'required',
            'amount' => 'required'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);

        
        // dd($request->all());
        $dt = Carbon::now();

        

        $consult = new Consult();
        $consult->patient_id = $request->input('patient');
        $consult->doctor_id = $request->input('doctor');
        $consult->concept_id = $request->input('concept');
        $consult->amount = $request->input('amount');
        $consult->other_patient = $request->input('other_patient');
        $cashier = Auth::user()->id;
        $consult->cashier_id = $cashier;
        $consult->outflow = false;
        $consult->dismount = false;
        if(Auth::user()->role_id == 1){
            $surgery_id = $request->input('surgery');
        }

        if(Auth::user()->role_id == 2){
            $surgery_id = Auth::user()->surgery_id;
        }
        
        $consult->surgery_id = $surgery_id;

        $paymentMetod = $request->input('payment_method') ? $request->input('payment_method') : 1;
        $consult->payment_method_id = $paymentMetod;
        
        

        $date_consult = $request->input('date-consult');
        if($date_consult){
            $date_consult = Carbon::createFromFormat('d/m/Y', $date_consult);
            if($date_consult < $dt){
                $dt = $date_consult;
                $consult->created_at = $dt;
            }
    
        }
        
        $consult->cashed_on = $dt;
        

        $consult->save();

        return redirect('/home');
    }

    public function edit($id)
    {   
        $consult = Consult::find($id);
        $patients = Patient::all();
        $doctors = User::where('role_id', '=', 3)->get();
        $services = Concept::all();
        
        if(Auth::user()->role_id != 1){
            $surgery_id = Auth::user()->surgery_id;
            $services = Concept::where('surgery_id', '=', $surgery_id)->get();  
        }

        $surgeries = Surgery::all();
        
        return view('consults.edit')->with(compact('services', 'doctors', 'patients', 'consult'));
    }

    public function update(Request $request, $id)
    {

        //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'surgery_id.required' => 'Debes de selecionar una tienda',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'digits' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
            'email' => 'Debes ingresar un email valido example@example.com'
        ];

        //Validaciones
        $rules = [
            'doctor' => 'required',
            'concept' => 'required',
            'amount' => 'required'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);
        
         // dd($request->all());
         $dt = Carbon::now();
         $consult = Consult::find($id);
         $consult->patient_id = $request->input('patient');
         $consult->doctor_id = $request->input('doctor');
         $consult->concept_id = $request->input('concept');
         $consult->amount = $request->input('amount');
         $consult->other_patient = $request->input('other_patient');
         $consult->cashed_on = $dt;
         if(Auth::user()->role_id == 1){
            $surgery_id = $request->input('surgery');
            $consult->surgery_id = $surgery_id;
        }
 
         $consult->save();
 
         return redirect('/consults');
    }

    public function delete($id)
    {
        $consult = Consult::find($id);
        $consult->delete();

        return back();
    }


    public function cashMovements(){
        $surgeries = Surgery::all();
        return view('consults.movements')->with(compact('surgeries'));
    }

    public function storeMovement(Request $request)
    {
        // dd($request->all());

        $dismount = $request->input('dismount');

        $dt = Carbon::now();
        $consult = new Consult();
        $consult->other_concept = $request->input('other_concept');
        $consult->amount = $request->input('amount');
        $cashier = Auth::user()->id;
        $consult->cashier_id = $cashier;
        if(Auth::user()->role_id == 1){
            $surgery_id = $request->input('surgery');
        }

        if(Auth::user()->role_id == 2){
            $surgery_id = Auth::user()->surgery_id;
        }
        
        $consult->surgery_id = $surgery_id;

        if($dismount == "on"){
            $dismount = true;
        }else{
            $dismount = false;
        }

        $consult->outflow = true;
        $consult->dismount = $dismount;

        $date_consult = $request->input('date-consult');
        if($date_consult){
            $date_consult = Carbon::createFromFormat('d/m/Y', $date_consult);
            if($date_consult < $dt){
                $dt = $date_consult;
                $consult->created_at = $dt;
            }
    
        }
        
        $consult->payment_method_id = 1;
        $consult->cashed_on = $dt;
        

        $consult->save();

        return redirect('/home');
    }


    public function search(Request $request){
        $sunday = Carbon::setWeekStartsAt(Carbon::SUNDAY);
        $saturday =  Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $filter = $request->input('filter');
        $filter = strtolower($filter);
        $filterArray = [$filter];
        if(Auth::user()->role_id == 1){
            $consults = Consult::whereRaw("LOWER(other_patient) LIKE ?", "%{$filter}%")
                        ->OrwhereRaw("LOWER(other_concept) LIKE ?", "%{$filter}%")
                        ->orderBy('created_at', 'desc')
                        ->get();
        }

        if(Auth::user()->role_id == 2){
            $user = Auth::user()->role_id;
            $consults = Consult::where('cashier_id', '=', $user)
                      ->whereBetween('created_at', [Carbon::now()
                      ->startOfWeek(), Carbon::now()->endOfWeek()])
                      ->orderBy('created_at', 'desc')
                      ->paginate();
        }

        return view('consults/consults')->with(compact('consults'));
    }



}
