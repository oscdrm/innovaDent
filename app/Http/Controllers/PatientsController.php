<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Address;
use Image;

class PatientsController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $patients = Patient::paginate(10);
        return view('patients/patients')->with(compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
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
            'name' => 'required | min:3',
            'lastName' => 'required | min:3',
            'age' => ' max:3',
            'telephone' => ' max:10 | min:10 | nullable',
            'email' => 'email | nullable',
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);

        // dd($request->all());
        $patient = new Patient();
        $patient->name = $request->input('name');
        $patient->lastName = $request->input('lastName');
        $patient->age = $request->input('age');
        $patient->telephone = $request->input('telephone');
        $email = $request->input('email');
        $patient->email = $email;
        
        $img_user = $request->file('user_photo');
        if($img_user){
        $user_photo = Image::make($img_user);
        $target = $email.".".$img_user->getClientOriginalExtension();
        $user_photo->resize(200,200);
        $ruta = public_path().'/img/';
        $user_photo->save($ruta.$target);
        $target = 'img/'.$email.".".$img_user->getClientOriginalExtension();

        $patient->user_photo = $target;
        }
        $patient->save();

        if($request->input('street') && $request->input('colonia')){
            $address = new Address();
            $address->street = $request->input('street');
            $address->number = $request->input('number');
            $address->colonia = $request->input('colonia');
            $address->cp = $request->input('cp');
            $address->patient_id = $patient->id;
            $address->save();
        }    

        return redirect('/patients');
    }

    public function edit($id)
    {   
        $patient = Patient::find($id);
        $add = null;
        if($patient->addresses->count() >= 1){
            $add = $patient->addresses->last();
        }
        return view('patients.edit')->with(compact('patient', 'add'));
    }

    public function update(Request $request, $id)
    {

        //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'alpha' => 'Solo puedes introducir letras para el campo :attribute',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'numeric' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
            'email' => 'Debes ingresar un email valido example@example.com'
        ];

        //Validaciones
        $rules = [
            'name' => 'required | alpha | min:3',
            'lastName' => 'required | alpha | min:3',
            'age' => 'max:3',
            'telephone' => 'max:10 | min:10',
            'email' => 'email',
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);
        
        // dd($request->all());
        $patient = Patient::find($id);
        $patient->name = $request->input('name');
        $patient->lastName = $request->input('lastName');
        $patient->age = $request->input('age');
        $patient->telephone = $request->input('telephone');
        $email = $request->input('email');
        $patient->email = $email;
        
        $img_user = $request->file('user_photo');
        $user_photo = Image::make($img_user);
        $target = $email.".".$img_user->getClientOriginalExtension();
        $user_photo->resize(200,200);
        $ruta = public_path().'/img/';
        $user_photo->save($ruta.$target);
        $target = 'img/'.$email.".".$img_user->getClientOriginalExtension();

        $patient->user_photo = $target;
        $patient->save();

        if($patient->addresses->count() >= 1){
            $add_id = $patient->addresses->last()->id;
            $address = Address::find($add_id);
            $address->street = $request->input('street');
            $address->number = $request->input('number');
            $address->colonia = $request->input('colonia');
            $address->cp = $request->input('cp');
            $address->patient_id = $patient->id;
            $address->save();
        }else{
            if($request->input('street') && $request->input('colonia')){
                $address = new Address();
                $address->street = $request->input('street');
                $address->number = $request->input('number');
                $address->colonia = $request->input('colonia');
                $address->cp = $request->input('cp');
                $address->patient_id = $patient->id;
                $address->save();
            }    
        }

        return redirect('/patients');
    }

    public function delete($id)
    {
        $patients = Patient::find($id);
        $patients->delete();

        return back();
    }


    public function profile($id){
        $patient = Patient::find($id);
        $add = null;
        if($patient->addresses->count() >= 1){
            $add = $patient->addresses->last();
        }

        $treatments = $patient->treatments;
        $consults = $patient->consults;
        $clinicHistories = $patient->clinicHistories;


        return view('patients.profile')->with(compact('treatment', 'patient', 'add', 'consults', 'clinicHistories'));
    }

}
