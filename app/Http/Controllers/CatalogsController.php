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
        $doctors = User::where('role_id', '=', 3)->where('username', 'admin')->get();
        if(!$services){
            $retArray = ['data' => ''];
            return response()->json($retArray);
        }

        $retArray = ['data' => $services];
        return response()->json($retArray);

    }

}
