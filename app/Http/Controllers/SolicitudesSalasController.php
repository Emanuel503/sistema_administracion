<?php

namespace App\Http\Controllers;

use App\Models\Autorizaciones;
use App\Models\Salas;
use App\Models\SolicitudesSalas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SolicitudesSalasController extends Controller
{
    public function comprobarHorario($id_sala, $fecha, $hora_inicio, $hora_finalizacion)
    {
        //Comprueba que la hora de incio sea menor a la hora de finalizacion
        if (strtotime($hora_inicio) >= strtotime($hora_finalizacion)) {
            return "errorHora";
        }
    }

    public function comprobarHorarioBd($id_sala, $fecha, $hora_inicio, $hora_finalizacion)
    {
        //Comprueba la disponibildiad de la sala
        $solicitudesSalas = SolicitudesSalas::all();

        foreach ($solicitudesSalas as $soli) {
            if (strtotime($fecha) == strtotime($soli->fecha)) {
                if (strtotime($hora_inicio) > strtotime($soli->hora_inicial) && strtotime($hora_inicio) <= strtotime($soli->hora_finalizacion)) {
                    return "noDisponible";
                }
            }
        }
    }

    public function index()
    {
        $solicitudesSalas = SolicitudesSalas::all();
        $salas = Salas::all();
        $autorizaciones = Autorizaciones::all();
        $usuarios = User::all();
        return view('solicitudes-salas', ['solicitudesSalas' => $solicitudesSalas, 'salas' => $salas, 'autorizaciones' => $autorizaciones, 'usuarios' => $usuarios]);
    }

    public function show($id)
    {
        $solicitudesSala = SolicitudesSalas::find($id);
        $salas = Salas::all();
        $autorizaciones = Autorizaciones::all();
        $usuarios = User::all();
        return view('show-solicitud-sala', ['solicitudesSala' => $solicitudesSala, 'salas' => $salas, 'autorizaciones' => $autorizaciones, 'usuarios' => $usuarios]);
    }

    public function edit($id)
    {
        $solicitudesSala = SolicitudesSalas::find($id);
        $salas = Salas::all();
        $autorizaciones = Autorizaciones::all();
        $usuarios = User::all();
        return view('edit-solicitud-sala', ['solicitudesSala' => $solicitudesSala, 'salas' => $salas, 'autorizaciones' => $autorizaciones, 'usuarios' => $usuarios]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_sala' => 'required',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_finalizacion' => 'required',
            'actividad' => 'required|min:5',
            'observaciones' => 'required|min:5'
        ]);

        $comprobar = $this->comprobarHorario($request->id_sala, $request->fecha, $request->hora_inicio, $request->hora_finalizacion);
        $comprobarBd = $this->comprobarHorarioBd($request->id_sala, $request->fecha, $request->hora_inicio, $request->hora_finalizacion);

        if ($comprobar == "errorHora") {
            return redirect()->route('solicitudes-sala.index')->with('errorHora', 'La hora de incio no puede ser mayor o igual a la hora de finalizacion');
        }

        if ($comprobarBd == "noDisponible") {
            return redirect()->route('solicitudes-sala.index')->with('noDisponible', 'La sala ya se encuentra reservada en ese horario');
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

        //$solicitudesSalas->save();
        //return redirect()->route('solicitudes-sala.index')->with('success', 'Solicitud de sala registrada correctamente');
    }

    public function update($id, Request $request)
    {
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

        return redirect()->route('solicitudes-sala.index')->with('success', 'Solicitud de sala actualizada correctamente');
    }

    public function destroy($id)
    {
        SolicitudesSalas::destroy($id);
        return redirect()->route('solicitudes-sala.index')->with('success', 'Solicitud de sala eliminada correctamente');
    }
}
