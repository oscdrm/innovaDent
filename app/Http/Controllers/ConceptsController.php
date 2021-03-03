<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concept;
use App\Surgery;

class ConceptsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $concepts = Concept::paginate(10);
        return view('concepts/concepts')->with(compact('concepts'));
    }

    public function create()
    {   
        $stores = Surgery::all();
        return view('concepts.create')->with(compact('stores'));
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
            'name' => 'required | min:3',
            'surgeries' => 'required'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);

        // dd($request->all());
        $concept = new Concept();
        $concept->name = $request->input('name');
        $concept->amount = $request->input('amount');
        try{
            $concept->save();

        }catch(\Illuminate\Database\QueryException $e){
            $errors = [];
            $errors['error'] = $e;
            
            return  back()->withErrors($errors);
        
        }
        
        //INSERTAMOS TAGS
        $surgeryReq = $request->input('surgeries');
        foreach($surgeryReq as $sr){
            $surgery = Surgery::find($sr);
            $concept->surgeries()->attach($surgery);
        }


        return redirect('/concepts');
    }

    public function edit($id)
    {   
        $concept = Concept::find($id);
        $stores = Surgery::all();
        $conceptsSurgery = [];
        if(!empty($concept->surgeries)){
            $conceptsSurgery = $concept->surgeries;
        }
        return view('concepts.edit')->with(compact('concept', 'stores', 'conceptsSurgery'));
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
            'name' => 'required | min:3',
            'surgeries' => 'required'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);
        
        // dd($request->all());
        $concept = Concept::find($id);
        $concept->name = $request->input('name');
        $concept->surgery_id = $request->input('surgery');
    
        $concept->save();

        return redirect('/concepts');
    }

    public function delete($id)
    {
        $concept = Concept::find($id);
        $concept->delete();

        return back();
    }
}
