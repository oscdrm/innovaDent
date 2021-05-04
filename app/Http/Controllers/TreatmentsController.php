<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Treatment;
use Carbon\Carbon;
use App\Consult;
use App\TreatmentSession;

class TreatmentsController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function treatments($id)
    {
        $treatments = Treatment::where('patient_id', $id)->orderBy('created_at', 'desc')->get();
        $treatArray = [];
        $retArray = [];
        $treatObj = [];
        if(!$treatments){
            $retArray = ['succesfull' => true, 'result' => ''];
            return response()->json($retArray);

        }

        foreach($treatments as $treatment){
            $treatObj = ['id' => $treatment->id, 'doctor' => $treatment->doctor->name.' '.$treatment->doctor->lastName,
                    'concept' => $treatment->concept->name, 'sessions' => $treatment->num_sesions, 'active' => $treatment->active];
            array_push($treatArray, $treatObj);
        }

        $retArray = ['succesfull' => true, 'result' => $treatArray];
        return response()->json($retArray);

    }


    public function store(Request $request, $id)
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

        
        $dt = Carbon::now();

        
        
        try{
            $treatment = new Treatment();
            $treatment->patient_id = $id;
            $treatment->doctor_id = $request->input('doctor');
            $treatment->concept_id = $request->input('concept');
            $treatment->total_cost = $request->input('amount');
            $treatment->num_sesions = $request->input('sessions');
            $treatment->start_date = $dt;
            $treatment->active = true;

            $retArray = [];
            $treatment->save();

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

}
