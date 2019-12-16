<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Surgery;

class StoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $stores = Surgery::paginate(10);
        return view('stores/stores')->with(compact('stores'));
    }

    public function create()
    {
        return view('stores.create');
    }

    public function store(Request $request)
    {

        //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'alpha' => 'Solo puedes introducir letras para el campo :attribute',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'digits' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
            'email' => 'Debes ingresar un email valido example@example.com'
        ];

        //Validaciones
        $rules = [
            'name' => 'required | min:3'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);

        // dd($request->all());
        $store = new Surgery();
        $store->name = $request->input('name');
        $store->address = $request->input('address');
        
        $store->save();

        return redirect('/stores');
    }

    public function edit($id)
    {   
        $store = Surgery::find($id);
        return view('stores.edit')->with(compact('store'));
    }

    public function update(Request $request, $id)
    {

        //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'alpha' => 'Solo puedes introducir letras para el campo :attribute',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'digits' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
            'email' => 'Debes ingresar un email valido example@example.com'
        ];

        //Validaciones
        $rules = [
            'name' => 'required | min:3'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);
        
        // dd($request->all());
        $store = Surgery::find($id);
        $store->name = $request->input('name');
        $store->address = $request->input('address');
    
        $store->save();

        return redirect('/stores');
    }

    public function delete($id)
    {
        $store = Surgery::find($id);
        $store->delete();

        return back();
    }
}
