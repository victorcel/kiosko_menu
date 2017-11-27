<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function con_tarjeta(Request $request)
    {
        $consulta=str_replace(['%','_','?'],'',$request->numeroid);
       $subs =substr($consulta,'4');
        return view('auth.login',['consulta' => $subs]);
    }
    public function con_cedula(Request $request)
    {
        $consulta=$request->cedula;
        return view('tarjeta',compact('consulta'));
        //return $consulta;
        //return $request;
        //  $consultat=substr($request->ced,'4');//$request->ced;
      //  return redirect()->route('index')->with('status',$request->tarjeta."---".$request->cedula);// response()->json($request);
        //return view('cliente',['consulta' => $consulta]);
    }

}
