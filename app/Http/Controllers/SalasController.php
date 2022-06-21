<?php

namespace App\Http\Controllers;

use App\Models\Autorizaciones;
use App\Models\Salas;
use App\Models\SolicitudesSalas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalasController extends Controller
{
    public function index(){
        $solicitudesSalas = SolicitudesSalas::all();
        $salas = Salas::all();
        $autorizaciones = Autorizaciones::all();
        return view('solicitudes-salas',['solicitudesSalas' => $solicitudesSalas, 'salas' => $salas, 'autorizaciones' => $autorizaciones]);
    }

    public function show($id){
        $solicitudesSalas = SolicitudesSalas::find($id);
        $salas = Salas::all();
        $autorizaciones = Autorizaciones::all();
        return view('show-solicitud-sala', ['solicitudesSalas' => $solicitudesSalas, 'salas' => $salas, 'autorizaciones' => $autorizaciones]);
    }

    public function store(Request $request){
        $request->validate([
            'id_sala' => 'required',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_finalizacion' => 'required',
            'actividad' => 'required|min:5|max:50',
            'observaciones' => 'required|min:5|max:50'
        ]);

        $solicitudesSalas = new SolicitudesSalas();
        $solicitudesSalas->id_autorizacion = 3;
        $solicitudesSalas->id_usuario =  Auth::user()->rol->id;
        $solicitudesSalas->id_sala = $request->id_sala;
        $solicitudesSalas->fecha = $request->fecha;
        $solicitudesSalas->hora_inicio = $request->hora_inicio;
        $solicitudesSalas->hora_finalizacion = $request->hora_finalizacion;
        $solicitudesSalas->actividad = $request->actividad;
        $solicitudesSalas->observaciones = $request->observaciones;

        $solicitudesSalas->save();
        return redirect()->route('solicitudes-sala.index')->with('success','Solicitud de sala registrada correctamente');
    }

    public function update($id,Request $request){
        $request->validate([
            'id_sala' => 'required',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_finalizacion' => 'required',
            'actividad' => 'required|min:5|max:50',
            'observaciones' => 'required|min:5|max:50'
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
