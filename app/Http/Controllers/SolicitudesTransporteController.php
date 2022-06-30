<?php

namespace App\Http\Controllers;

use App\Models\Autorizaciones;
use App\Models\DependenciasTransporte;
use App\Models\Lugares;
use App\Models\SolicitudesTransportes;
use App\Models\User;
use App\Models\Vehiculos;
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
        $vehiculos = Vehiculos::all();
        return view('solicitudes-transportes', ['solicitudesTransportes' => $solicitudesTransportes, 'dependencias' => $dependencias, 'lugares' => $lugares, 'autorizaciones' => $autorizaciones, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos]);
    }

    public function show($id)
    {
        $solicitudesTransportes = SolicitudesTransportes::find($id);
        $dependencias = DependenciasTransporte::all();
        $lugares = Lugares::all();
        $autorizaciones = Autorizaciones::all();
        $usuarios = User::all();
        $vehiculos = Vehiculos::all();
        return view('show-solicitud-transporte', ['solicitudesTransportes' => $solicitudesTransportes, 'dependencias' => $dependencias, 'lugares' => $lugares, 'autorizaciones' => $autorizaciones, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos]);
    }

    public function edit($id)
    {
        $solicitudesTransportes = SolicitudesTransportes::find($id);
        $dependencias = DependenciasTransporte::all();
        $lugares = Lugares::all();
        $autorizaciones = Autorizaciones::all();
        $usuarios = User::all();
        $vehiculos = Vehiculos::all();
        return view('edit-solicitud-transporte', ['solicitudesTransportes' => $solicitudesTransportes, 'dependencias' => $dependencias, 'lugares' => $lugares, 'autorizaciones' => $autorizaciones, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos]);
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
            return redirect()->route('solicitudes-transporte.index')->with('errorHora', 'La hora de salida no puede ser mayor o igual a la hora de regreso')->withInput();
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
        $solicitudesTransporte->lugar_solicitud = "San Salvador";

        $solicitudesTransporte->save();
        return redirect()->route('solicitudes-transporte.index')->with('success', 'Solicitud de transporte registrada correctamente');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'id_dependencia' => 'required',
            'id_lugar' => 'required',
            'id_autorizacion' => 'required',
            'fecha' => 'required|date',
            'hora_salida' => 'required',
            'hora_regreso' => 'required',
            'objetivo' => 'required|min:5',
            'observaciones' => 'required|min:5'
        ]);

        //Comprueba que la hora de incio sea menor a la hora de finalizacion
        if (strtotime($request->hora_salida) >= strtotime($request->hora_regreso)) {
            return redirect()->route('solicitudes-transporte.edit', ['solicitudes_transporte' => $id])->with('errorHora', 'La hora de salida no puede ser mayor o igual a la hora de regreso')->withInput();
        }

        $solicitudesTransporte = SolicitudesTransportes::find($id);

        if ($request->id_autorizacion == 1) {
            $request->validate([
                'id_motorista' => 'required',
                'id_vehiculo' => 'required'
            ]);

            //Obtiene todos lo registro de coicidan con la hora ingresada, el vehiculo y el dia
            $solicitudes = DB::select(
                "SELECT * FROM solicitudes_transportes WHERE (hora_salida BETWEEN ? AND ? OR hora_regreso BETWEEN ? AND  ?) and id_vehiculo= ? and fecha = ?",
                [$request->hora_salida, $request->hora_regreso, $request->hora_salida, $request->hora_regreso, $request->id_vehiculo, $request->fecha]
            );

            if (sizeof($solicitudes) > 0) {
                return redirect()->route('solicitudes-transporte.edit', ['solicitudes_transporte' => $id])->with('errorVehiculo', 'El vehiculo seleccionado ya se encuentra reservado para ese horario');
            }

            $solicitudes = DB::select("SELECT * FROM solicitudes_transportes WHERE id_vehiculo= ? and fecha = ?", [$request->id_vehiculo, $request->fecha]);
            foreach ($solicitudes as $solicitud) {
                if (
                    strtotime($request->hora_salida) >= strtotime($solicitud->hora_salida) &&
                    strtotime($request->hora_salida) <= strtotime($solicitud->hora_regreso)
                ) {
                    return redirect()->route('solicitudes-transporte.edit', ['solicitudes_transporte' => $id])->with('errorVehiculo', 'El vehiculo seleccionado ya se encuentra reservado para ese horario');
                }
            }

            //Obtiene todos lo registro de coicidan con la hora ingresada, el motorista y el dia
            $solicitudes = DB::select(
                "SELECT * FROM solicitudes_transportes WHERE (hora_salida BETWEEN ? AND ? OR hora_regreso BETWEEN ? AND  ?) and id_motorista= ? and fecha = ?",
                [$request->hora_salida, $request->hora_regreso, $request->hora_salida, $request->hora_regreso, $request->id_motorista, $request->fecha]
            );

            if (sizeof($solicitudes) > 0) {
                return redirect()->route('solicitudes-transporte.edit', ['solicitudes_transporte' => $id])->with('errorMotorista', 'El motorista seleccionado ya se encuentra reservado para ese horario');
            }

            $solicitudes = DB::select("SELECT * FROM solicitudes_transportes WHERE id_motorista= ? and fecha = ?", [$request->id_motorista, $request->fecha]);
            foreach ($solicitudes as $solicitud) {
                if (
                    strtotime($request->hora_salida) >= strtotime($solicitud->hora_salida) &&
                    strtotime($request->hora_salida) <= strtotime($solicitud->hora_regreso)
                ) {
                    return redirect()->route('solicitudes-transporte.edit', ['solicitudes_transporte' => $id])->with('errorMotorista', 'El motorista seleccionado ya se encuentra reservado para ese horario');
                }
            }

            $solicitudesTransporte->id_motorista = $request->id_motorista;
            $solicitudesTransporte->id_vehiculo = $request->id_vehiculo;
        } else {
            $solicitudesTransporte->id_motorista = null;
            $solicitudesTransporte->id_vehiculo = null;
        }

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
