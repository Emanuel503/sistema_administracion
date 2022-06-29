<?php

namespace App\Http\Controllers;

use App\Models\Lugares;
use App\Models\SolicitudCombustible;
use App\Models\User;
use App\Models\Vehiculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SolicitudCombustibleController extends Controller
{
    public function index()
    {
        $solicitudes = SolicitudCombustible::all();
        $usuarios = User::all();
        $vehiculos = Vehiculos::all();
        $lugares = Lugares::all();

        return view('solicitud-combustible', ['solicitudes' => $solicitudes, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos, 'lugares' => $lugares]);
    }

    public function show($id)
    {
        $solicitudes = SolicitudCombustible::find($id);
        $usuarios = User::all();
        $vehiculos = Vehiculos::all();
        $lugares = Lugares::all();

        return view('show-solicitud-combustible', ['solicitudes' => $solicitudes, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos, 'lugares' => $lugares]);
    }

    public function edit($id)
    {
        $solicitudes = SolicitudCombustible::find($id);
        $usuarios = User::all();
        $vehiculos = Vehiculos::all();
        $lugares = Lugares::all();

        return view('edit-solicitud-combustible', ['solicitudes' => $solicitudes, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos, 'lugares' => $lugares]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_organizador' => 'required',
            'id_coordinador' => 'required',
            'id_lugar' => 'required',
            'title' => 'required|min:5',
            'fecha_inicio' => 'required|date',
            'fecha_finalizacion' => 'required|date',
            'hora_inicio' => 'required',
            'hora_finalizacion' => 'required',
            'objetivo' => 'required|min:5',
            'observaciones' => 'required|min:5'
        ]);

        $comprobar = $this->comprobarHorario($request->fecha_inicio, $request->fecha_finalizacion, $request->hora_inicio, $request->hora_finalizacion);

        if ($comprobar == "errorHora") {
            return redirect()->route('actividades.index')->with('errorHora', 'La hora de incio no puede ser mayor o igual a la hora de finalizacion')->withInput();
        }

        if ($comprobar == "errorFecha") {
            return redirect()->route('actividades.index')->with('errorFecha', 'La fecha de incio no puede ser mayor a la fecha de finalizacion')->withInput();
        }

        $actividad = new Actividades();
        $actividad->id_organizador = $request->id_organizador;
        $actividad->id_lugar = $request->id_lugar;
        $actividad->id_coordinador = $request->id_coordinador;
        $actividad->id_estado = 5;
        $actividad->title = $request->title;
        $actividad->fecha_inicio = $request->fecha_inicio;
        $actividad->fecha_finalizacion = $request->fecha_finalizacion;
        $actividad->hora_inicio = $request->hora_inicio;
        $actividad->hora_finalizacion = $request->hora_finalizacion;
        $actividad->objetivo = $request->objetivo;
        $actividad->observaciones = $request->observaciones;
        $actividad->start = $request->fecha_inicio . ' ' . $request->hora_inicio;;
        $actividad->end = $request->fecha_finalizacion . ' ' . $request->hora_finalizacion;

        $actividad->save();

        return redirect()->route('actividades.index')->with('success', 'Actividad guardada correctamente.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'id_destinatario' => 'required',
            'id_origen' => 'required',
            'fecha_solicitud' => 'required',
            'id_placa' => 'required',
            'id_conductor' => 'required',
            'lugar_destino' => 'required',
            'fecha_detalle' => 'required',
            'hora_salida' => 'required',
            'objetivo' => 'required',
            'tipo_combustible' => 'required',
            'cantidad_combustible' => 'required'
        ]);

        $solicitud = SolicitudCombustible::find($id);

        $km = DB::select("SELECT kilometraje FROM vehiculos WHERE id = ?", [$request->id_placa]);

        $solicitud->id_destinatario = $request->id_destinatario;
        $solicitud->id_origen = $request->id_origen;
        $solicitud->fecha_solicitud = $request->fecha_solicitud;
        $solicitud->id_placa = $request->id_placa;
        $solicitud->id_conductor = $request->id_conductor;
        $solicitud->lugar_destino = $request->lugar_destino;
        $solicitud->fecha_detalle = $request->fecha_detalle;
        $solicitud->hora_salida = $request->hora_salida;
        $solicitud->objetivo = $request->objetivo;
        $solicitud->tipo_combustible = $request->tipo_combustible;
        $solicitud->cantidad_combustible = $request->cantidad_combustible;
        $solicitud->kilometraje = $request->id_placa;



        $solicitud->save();

        return redirect()->route('solicitud-combustible.index')->with('success', 'Actividad actualizada correctamente');
    }

    public function destroy($id)
    {
        SolicitudCombustible::destroy($id);
        return redirect()->route('solicitud-combustible.index')->with('success', 'Actividad eliminada correctamente');
    }
}
