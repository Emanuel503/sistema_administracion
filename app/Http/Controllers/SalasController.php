<?php

namespace App\Http\Controllers;

use App\Models\Autorizaciones;
use App\Models\Salas;
use App\Models\SolicitudesSalas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalasController extends Controller
{
    public function comprobarDisponibilidad($fecha, $hora_inicio, $hora_finalizacion){
        $solicitudesSalas = SolicitudesSalas::where('fecha', $fecha)->get();

        if(sizeof($solicitudesSalas) > 0){
            return true;
        }else{
            return false;
        }   
    }

    public function index(){
        $solicitudesSalas = SolicitudesSalas::all();
        $salas = Salas::all();
        $autorizaciones = Autorizaciones::all();
        $usuarios = User::all();
        return view('solicitudes-salas',['solicitudesSalas' => $solicitudesSalas, 'salas' => $salas, 'autorizaciones' => $autorizaciones, 'usuarios' => $usuarios]);
    }

    public function show($id){
        $solicitudesSala = SolicitudesSalas::find($id);
        $salas = Salas::all();
        $autorizaciones = Autorizaciones::all();
        $usuarios = User::all();
        return view('show-solicitud-sala', ['solicitudesSala' => $solicitudesSala, 'salas' => $salas, 'autorizaciones' => $autorizaciones,'usuarios' => $usuarios]);
    }

    public function store(Request $request){
        $request->validate([
            'id_sala' => 'required',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_finalizacion' => 'required',
            'actividad' => 'required|min:5',
            'observaciones' => 'required|min:5'
        ]);

        $comprobar = $this->comprobarDisponibilidad($request->fecha, $request->hora_inicio, $request->hora_finalizacion);
        if($comprobar){
            return redirect()->route('solicitudes-sala.index')->with('ocupada','Ya hay una solicitud de sala registrada');
        }

        $solicitudesSalas = new SolicitudesSalas();
        $solicitudesSalas->id_autorizacion = 3;
        $solicitudesSalas->id_usuario =  Auth::user()->id;
        $solicitudesSalas->id_sala = $request->id_sala;
        $solicitudesSalas->fecha = $request->fecha;
        $solicitudesSalas->hora_inicio = $request->hora_inicio;
        $solicitudesSalas->hora_finalizacion = $request->hora_finalizacion;
        $solicitudesSalas->actividad = $request->actividad;
        $solicitudesSalas->observaciones = $request->observaciones;

        $solicitudesSalas->save();
        return redirect()->route('solicitudes-sala.index')->with('success','Solicitud de sala registrada correctamente');
    }

    public function update($id, Request $request){
        $request->validate([
            'id_sala' => 'required',
            'id_autorizacion' => 'required',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_finalizacion' => 'required',
            'actividad' => 'required|min:5',
            'observaciones' => 'required|min:5'
        ]);

        $solicitudesSalas = SolicitudesSalas::find($id);
        $solicitudesSalas->id_autorizacion = $request->id_autorizacion;
        $solicitudesSalas->id_sala = $request->id_sala;
        $solicitudesSalas->fecha = $request->fecha;
        $solicitudesSalas->hora_inicio = $request->hora_inicio;
        $solicitudesSalas->hora_finalizacion = $request->hora_finalizacion;
        $solicitudesSalas->actividad = $request->actividad;
        $solicitudesSalas->observaciones = $request->observaciones;
        
        $solicitudesSalas->save();

        return redirect()->route('solicitudes-sala.index')->with('success','Solicitud de sala actualizada correctamente');
    }

    public function destroy($id){
        SolicitudesSalas::destroy($id);
        return redirect()->route('solicitudes-sala.index')->with('success','Solicitud de sala eliminada correctamente');
    } 
}
