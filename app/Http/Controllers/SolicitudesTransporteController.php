<?php

namespace App\Http\Controllers;

use App\Models\Autorizaciones;
use App\Models\DependenciasTransporte;
use App\Models\Lugares;
use App\Models\SolicitudesTransportes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SolicitudesTransporteController extends Controller
{
    public function index()
    {
        $solicitudesTransportes = SolicitudesTransportes::all();
        $dependencias = DependenciasTransporte::all();
        $lugares = Lugares::all();
        $autorizaciones = Autorizaciones::all();
        $usuarios = User::all();
        return view('solicitudes-transportes', ['solicitudesTransportes' => $solicitudesTransportes, 'dependencias' => $dependencias, 'lugares' => $lugares, 'autorizaciones' => $autorizaciones, 'usuarios' => $usuarios]);
    }

    public function show($id)
    {
        $solicitudesTransportes = SolicitudesTransportes::find($id);
        $dependencias = DependenciasTransporte::all();
        $lugares = Lugares::all();
        $autorizaciones = Autorizaciones::all();
        $usuarios = User::all();
        return view('show-solicitud-transporte', ['solicitudesTransportes' => $solicitudesTransportes, 'dependencias' => $dependencias, 'lugares' => $lugares, 'autorizaciones' => $autorizaciones, 'usuarios' => $usuarios]);
    }

    public function edit($id)
    {
        $solicitudesTransportes = SolicitudesTransportes::find($id);
        $dependencias = DependenciasTransporte::all();
        $lugares = Lugares::all();
        $autorizaciones = Autorizaciones::all();
        $usuarios = User::all();
        return view('edit-solicitud-transporte', ['solicitudesTransportes' => $solicitudesTransportes, 'dependencias' => $dependencias, 'lugares' => $lugares, 'autorizaciones' => $autorizaciones, 'usuarios' => $usuarios]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_dependencia' => 'required',
            'id_lugar' => 'required',
            'fecha' => 'required|date',
            'hora_salida' => 'required',
            'hora_regreso' => 'required',
            'objetivo' => 'required|min:5',
            'observaciones' => 'required|min:5'
        ]);

        //Comprueba que la hora de incio sea menor a la hora de finalizacion
        if (strtotime($request->hora_salida) >= strtotime($request->hora_regreso)) {
            return redirect()->route('solicitudes-transporte.index')->with('errorHora', 'La hora de salida no puede ser mayor o igual a la hora de regreso');
        }

        $solicitudesTransporte = new SolicitudesTransportes();
        $solicitudesTransporte->id_dependencia = $request->id_dependencia;
        $solicitudesTransporte->id_lugar = $request->id_lugar;
        $solicitudesTransporte->id_usuario =  Auth::user()->id;
        $solicitudesTransporte->id_autorizacion = 3;
        $solicitudesTransporte->fecha = $request->fecha;
        $solicitudesTransporte->hora_salida = $request->hora_salida;
        $solicitudesTransporte->hora_regreso = $request->hora_regreso;
        $solicitudesTransporte->objetivo = $request->objetivo;
        $solicitudesTransporte->observaciones = $request->observaciones;
        $solicitudesTransporte->fecha_solicitud = $date = Carbon::now();
        $solicitudesTransporte->lugar_solicitud = "San Salvador";

        $solicitudesTransporte->save();
        return redirect()->route('solicitudes-transporte.index')->with('success', 'Solicitud de transporte registrada correctamente');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'id_dependencia' => 'required',
            'id_lugar' => 'required',
            'fecha' => 'required|date',
            'hora_salida' => 'required',
            'hora_regreso' => 'required',
            'objetivo' => 'required|min:5',
            'observaciones' => 'required|min:5'
        ]);

        //Comprueba que la hora de incio sea menor a la hora de finalizacion
        if (strtotime($request->hora_salida) >= strtotime($request->hora_regreso)) {
            return redirect()->route('solicitudes-transporte.index')->with('errorHora', 'La hora de salida no puede ser mayor o igual a la hora de regreso');
        }

        $solicitudesTransporte = SolicitudesTransportes::find($id);
        $solicitudesTransporte->id_dependencia = $request->id_dependencia;
        $solicitudesTransporte->id_lugar = $request->id_lugar;
        $solicitudesTransporte->id_autorizacion = $request->id_autorizacion;
        $solicitudesTransporte->fecha = $request->fecha;
        $solicitudesTransporte->hora_salida = $request->hora_salida;
        $solicitudesTransporte->hora_regreso = $request->hora_regreso;
        $solicitudesTransporte->objetivo = $request->objetivo;
        $solicitudesTransporte->observaciones = $request->observaciones;

        $solicitudesTransporte->save();
        return redirect()->route('solicitudes-transporte.index')->with('success', 'Solicitud de transporte actualizada correctamente');
    }

    public function destroy($id)
    {
        SolicitudesTransportes::destroy($id);
        return redirect()->route('solicitudes-transporte.index')->with('success', 'Solicitud de transporte eliminada correctamente');
    }
}
