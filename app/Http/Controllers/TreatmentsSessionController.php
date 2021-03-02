<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Treatment;
use Carbon\Carbon;
use App\Consult;
use App\TreatmentSession;

class TreatmentsSessionController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store_session(Request $request, $id)
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
            'payment' => 'required'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);

        
        $dt = Carbon::now();

        
        
        try{
            $session = new TreatmentSession();

            $prev_session = TreatmentSession::latest('created_at')->first();

            if($prev_session){
                $num_session = $prev_session->num_session + 1;
            }else{
                $num_session = 1;
            }

            $session->num_session = $num_session;
            $session->message = $request->input('message') ? $request->input('message') : '';
            $session->treatment_id = $id;
            $session->payment = $request->input('payment');

            $retArray = [];
            $session->save();

            $retArray = ['succesfull' => true, 'result' => 'save'];
            return response()->json($retArray);
        
         }
         catch(\Exception $e){
            // do task when error
            echo $e->getMessage();   // insert query
            $retArray = ['succesfull' => true, 'result' => 'error', 'message' => $e->getMessage()];
            return response()->json($retArray);
            //echo $e->getMessage();   // insert query
         }
        
    }

    public function treatmentSessions($id)
    {   
        $treatment = Treatment::find($id);
        $sessions = TreatmentSession::where('treatment_id', '=', $id)->get();
        $sessionArray = [];
        $retArray = [];
        $sesObj = [];

        if(!$sessions){
            $retArray = ['succesfull' => true, 'result' => ''];
            return response()->json($retArray);
        }

        foreach($sessions as $session){

            $sesObj = ['id' => $session->id, 
                       'ns' => $session->num_session,
                       'message' => $session->message,
                       'payment' => $session->payment];
            
            array_push($sessionArray, $sesObj);

        }

        $retArray = ['succesful' => true, 'result' => $sessionArray];
        return response()->json($retArray);
    }


}
