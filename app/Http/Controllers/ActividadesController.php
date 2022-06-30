<?php

namespace App\Http\Controllers;

use App\Models\Actividades;
use App\Models\EstadosActividades;
use App\Models\Lugares;
use App\Models\User;
use Illuminate\Http\Request;

class ActividadesController extends Controller
{
    public function comprobarHorario($fecha_inicio, $fecha_finalizacion, $hora_inicio, $hora_finalizacion)
    {
        if (strtotime($hora_inicio) >= strtotime($hora_finalizacion) && strtotime($fecha_inicio) == strtotime($hora_finalizacion)) {
            return "errorHora";
        }

        if (strtotime($fecha_inicio) > strtotime($fecha_finalizacion)) {
            return "errorFecha";
        }
    }

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

    public function edit($id)
    {
        $actividades = Actividades::find($id);
        $coordinadores = User::all();
        $lugares = Lugares::all();
        $organizadores = Lugares::all();
        $estados = EstadosActividades::all();

        return view('edit-actividad', ['actividades' => $actividades, 'coordinadores' => $coordinadores, 'lugares' => $lugares, 'organizadores' => $organizadores, 'estados' => $estados]);
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
            'id_organizador' => 'required',
            'id_coordinador' => 'required',
            'id_lugar' => 'required',
            'id_estado' => 'required',
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
            return redirect()->route('actividades.edit', ['actividade' => $id])->with('errorHora', 'La hora de incio no puede ser mayor o igual a la hora de finalizacion')->withInput();
        }

        if ($comprobar == "errorFecha") {
            return redirect()->route('actividades.edit', ['actividade' => $id])->with('errorFecha', 'La fecha de incio no puede ser mayor a la fecha de finalizacion')->withInput();
        }

        $actividad = Actividades::find($id);

        $actividad->id_organizador = $request->id_organizador;
        $actividad->id_lugar = $request->id_lugar;
        $actividad->id_coordinador = $request->id_coordinador;
        $actividad->title = $request->title;
        $actividad->fecha_inicio = $request->fecha_inicio;
        $actividad->fecha_finalizacion = $request->fecha_finalizacion;
        $actividad->hora_inicio = $request->hora_inicio;
        $actividad->hora_finalizacion = $request->hora_finalizacion;
        $actividad->objetivo = $request->objetivo;
        $actividad->observaciones = $request->observaciones;
        $actividad->id_estado = $request->id_estado;
        $actividad->start = $request->fecha_inicio . ' ' . $request->hora_inicio;;
        $actividad->end = $request->fecha_finalizacion . ' ' . $request->hora_finalizacion;

        $actividad->save();

        return redirect()->route('actividades.index')->with('success', 'Actividad actualizada correctamente');
    }

    public function destroy($id)
    {
        Actividades::destroy($id);
        return redirect()->route('actividades.index')->with('success', 'Actividad eliminada correctamente');
    }
}
