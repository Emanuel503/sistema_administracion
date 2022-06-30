<?php

namespace App\Http\Controllers;

use App\Models\Autorizaciones;
use App\Models\Salas;
use App\Models\SolicitudesSalas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SolicitudesSalasController extends Controller
{
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

        //Comprueba que la hora de incio sea menor a la hora de finalizacion
        if (strtotime($request->hora_inicio) >= strtotime($request->hora_finalizacion)) {
            return redirect()->route('solicitudes-sala.index')->with('errorHora', 'La hora de incio no puede ser mayor o igual a la hora de finalizacion')->withInput();;
        }

        //Obtiene todos lo registro de coicidan con la hora ingresada, la sala y el dia
        $solicitudesSalas = DB::select(
            "SELECT * FROM solicitudes_salas WHERE (hora_inicio BETWEEN ? AND ? OR hora_finalizacion BETWEEN ? AND ?) and id_sala= ? and fecha = ?",
            [$request->hora_inicio, $request->hora_finalizacion, $request->hora_inicio, $request->hora_finalizacion, $request->id_sala, $request->fecha]
        );

        if (sizeof($solicitudesSalas) > 0) {
            return redirect()->route('solicitudes-sala.index')->with('errorHora', 'La sala selecciona ya se encuentra reservada para ese horario')->withInput();;
        }

        $solicitudesSalas = DB::select("SELECT * FROM solicitudes_salas WHERE id_sala= ? and fecha = ?", [$request->id_sala, $request->fecha]);
        foreach ($solicitudesSalas as $solicitud) {

            if (
                strtotime($request->hora_inicio) >= strtotime($solicitud->hora_inicio) &&
                strtotime($request->hora_inicio) <= strtotime($solicitud->hora_finalizacion)
            ) {
                return redirect()->route('solicitudes-sala.index')->with('errorHora', 'La sala selecciona ya se encuentra reservada para ese horario')->withInput();;
            }
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
        return redirect()->route('solicitudes-sala.index')->with('success', 'Solicitud de sala registrada correctamente');
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

        //Comprueba que la hora de incio sea menor a la hora de finalizacion
        if (strtotime($request->hora_inicio) >= strtotime($request->hora_finalizacion)) {
            return redirect()->route('solicitudes-sala.edit', ['solicitudes_sala' => $id])->with('errorHora', 'La hora de incio no puede ser mayor o igual a la hora de finalizacion')->withInput();;
        }

        //Obtiene todos lo registro de cocidan con la hora ingresada, la sala y el dia
        $solicitudesSalas = DB::select(
            "SELECT * FROM solicitudes_salas WHERE (hora_inicio BETWEEN ? AND ? OR hora_finalizacion BETWEEN ? AND ?) and id_sala= ? and fecha = ? and id != ?",
            [$request->hora_inicio, $request->hora_finalizacion, $request->hora_inicio, $request->hora_finalizacion, $request->id_sala, $request->fecha, $id]
        );

        if (sizeof($solicitudesSalas) > 0) {
            return redirect()->route('solicitudes-sala.edit', ['solicitudes_sala' => $id])->with('errorHora', 'La sala selecciona ya se encuentra reservada para ese horario')->withInput();;
        }

        $solicitudesSalas = DB::select("SELECT * FROM solicitudes_salas WHERE id_sala= ? and fecha = ? and id != ?", [$request->id_sala, $request->fecha, $id]);
        foreach ($solicitudesSalas as $solicitud) {

            if (
                strtotime($request->hora_inicio) >= strtotime($solicitud->hora_inicio) &&
                strtotime($request->hora_inicio) <= strtotime($solicitud->hora_finalizacion)
            ) {
                return redirect()->route('solicitudes-sala.edit', ['solicitudes_sala' => $id])->with('errorHora', 'La sala selecciona ya se encuentra reservada para ese horario')->withInput();;
            }
        }

        $solicitudesSalas = SolicitudesSalas::find($id);
        $solicitudesSalas->id_autorizacion = $request->id_autorizacion;
        $solicitudesSalas->id_sala = $request->id_sala;
        $solicitudesSalas->fecha = $request->fecha;
        $solicitudesSalas->hora_inicio = $request->hora_inicio;
        $solicitudesSalas->hora_finalizacion = $request->hora_finalizacion;
        $solicitudesSalas->actividad = $request->actividad;
        $solicitudesSalas->observaciones = $request->observaciones;

        $solicitudesSalas->save();

        return redirect()->route('solicitudes-sala.edit', ['solicitudes_sala' => $id])->with('success', 'Solicitud de sala actualizada correctamente');
    }

    public function destroy($id)
    {
        SolicitudesSalas::destroy($id);
        return redirect()->route('solicitudes-sala.index')->with('success', 'Solicitud de sala eliminada correctamente');
    }
}
