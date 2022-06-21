<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Lugares;
use App\Models\User;
use Illuminate\Http\Request;

class ActividadesController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        $lugares = Lugares::all();
        $organizador = Lugares::all();

        return view('actividades', ['usuarios' => $usuarios, 'lugares' => $lugares, 'organizador' => $organizador]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_organizador' => 'required',
            'id_lugar' => 'required',
            'id_coordinador' => 'required',
            'nombre_actividad' => 'required',
            'fecha_inicio' => 'required',
            'fecha_finalizacion' => 'required',
            'hora_inicio' => 'required',
            'hora_finalizacion' => 'required',
            'objetivo' => 'required',
            'observaciones' => 'required',
            'estado' => 'required'
        ]);

        $actividad = new Actividad();

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
        $actividad->estado = $request->estado;

        $actividad->save();

        return redirect()->route('actividades')->with('success', 'Actividad guardada correctamente.');
    }
}
