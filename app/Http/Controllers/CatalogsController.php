<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concept;
use App\User;

class CatalogsController extends Controller
{
    
    public function servicesCatalog(){
        $retArray = [];
        $services = Concept::where('surgery_id', '=', 1)->get();
        if(!$services){
            $retArray = ['data' => ''];
            return response()->json($retArray);
        }
        $retArray = ['data' => $services];
        return response()->json($retArray);
    }

    public function doctorsCatalog(){
        $retArray = [];
        $doctors = User::where('role_id', '=', 3)->orWhere('username', 'admin')->get();
        if(!$doctors){
            $retArray = ['data' => ''];
            return response()->json($retArray);
        }

        $docArray = [];
        foreach($doctors as $doctor){
            $docObj = ['id' => $doctor->id, 'name' => $doctor->name.' '.$doctor->lastName];
            array_push($docArray, $docObj);
        }

        $retArray = ['data' => $docArray];
        return response()->json($retArray);

    }

}
