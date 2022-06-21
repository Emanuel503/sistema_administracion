<?php

namespace App\Http\Controllers;

use App\Models\Actividades;
use App\Models\EstadosActividades;
use Illuminate\Http\Request;
use App\Models\Lugares;
use App\Models\User;

class ActividadesController extends Controller
{
    public function index()
    {
        $actividades = Actividades::all();
        $usuarios = User::all();
        $lugares = Lugares::all();
        $organizadores = Lugares::all();
        $estados = EstadosActividades::all();

        return view('actividades', ['actividades' => $actividades, 'usuarios' => $usuarios, 'lugares' => $lugares, 'organizadores' => $organizadores, 'estados' => $estados]);
    }

    public function show($id)
    {
        $actividades = Actividades::find($id);
        $coordinadores = User::all();
        $lugares = Lugares::all();
        $organizadores = Lugares::all();
        $estados = EstadosActividades::all();

        return view('show-actividad', ['actividades' => $actividades, 'coordinadores' => $coordinadores, 'lugares' => $lugares, 'organizadores' => $organizadores, 'estados' => $estados]);
    }

    public function showCalendar()
    {
        $actividad = Actividades::all();

        return response()->json($actividad);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_organizador' => 'required',
            'id_coordinador' => 'required',
            'id_lugar' => 'required',
            'id_estado' => 'required',
            'nombre_actividad' => 'required',
            'fecha_inicio' => 'required',
            'fecha_finalizacion' => 'required',
            'hora_inicio' => 'required',
            'hora_finalizacion' => 'required',
            'objetivo' => 'required',
            'observaciones' => 'required'
        ]);

        $actividad = new Actividades();

        $actividad->id_organizador = $request->id_organizador;
        $actividad->id_lugar = $request->id_lugar;
        $actividad->id_coordinador = $request->id_coordinador;
        $actividad->nombre_actividad = $request->nombre_actividad;
        $actividad->fecha_inicio = $request->fecha_inicio;
        $actividad->fecha_finalizacion = $request->fecha_finalizacion;
        $actividad->hora_inicio = $request->hora_inicio;
        $actividad->hora_finalizacion = $request->hora_finalizacion;
        $actividad->objetivo = $request->objetivo;
        $actividad->observaciones = $request->observaciones;
        $actividad->id_estado = $request->id_estado;

        $actividad->save();

        return redirect()->route('actividades.index')->with(
            'success',
            'Actividad guardada correctamente.'
        );
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'id_organizador' => 'required',
            'id_coordinador' => 'required',
            'id_lugar' => 'required',
            'id_estado' => 'required',
            'nombre_actividad' => 'required',
            'fecha_inicio' => 'required',
            'fecha_finalizacion' => 'required',
            'hora_inicio' => 'required',
            'hora_finalizacion' => 'required',
            'objetivo' => 'required',
            'observaciones' => 'required'
        ]);

        $actividad = Actividades::find($id);

        $actividad->id_organizador = $request->id_organizador;
        $actividad->id_lugar = $request->id_lugar;
        $actividad->id_coordinador = $request->id_coordinador;
        $actividad->nombre_actividad = $request->nombre_actividad;
        $actividad->fecha_inicio = $request->fecha_inicio;
        $actividad->fecha_finalizacion = $request->fecha_finalizacion;
        $actividad->hora_inicio = $request->hora_inicio;
        $actividad->hora_finalizacion = $request->hora_finalizacion;
        $actividad->objetivo = $request->objetivo;
        $actividad->observaciones = $request->observaciones;
        $actividad->id_estado = $request->id_estado;

        $actividad->save();

        return redirect()->route('actividades.index')->with('success', 'Actividad actualizada correctamente');
    }

    public function destroy($id)
    {
        Actividades::destroy($id);
        return redirect()->route('actividades.index')->with('success', 'Actividad eliminada correctamente');
    }
}
