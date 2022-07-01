<?php

namespace App\Http\Controllers;

use App\Models\RegistrosSalidas;
use App\Models\Lugares;
use App\Models\EstadosSalidas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrosSalidasController extends Controller
{
    public function comprobarHoras($hora_salida, $hora_fin)
    {
        if (strtotime($hora_fin) <= strtotime($hora_salida)) {
            return "errorHora";
        }
    }

    public function index(){
        $salidas = RegistrosSalidas::all();
        $lugares = Lugares::all();
        $estados = EstadosSalidas::all();
        $usuarios = User::all();
        return view('registros-salidas', ['salidas'=> $salidas, 'lugares' => $lugares, 'estados' => $estados, 'usuarios' => $usuarios]);
    }

    public function show($id)
    {
        $salidas = RegistrosSalidas::find($id);
        $lugares = Lugares::all();
        $estados = EstadosSalidas::all();
        $usuarios = User::all();
        return view('show-registros-salidas', ['salidas'=> $salidas, 'lugares' => $lugares, 'estados' => $estados, 'usuarios' => $usuarios]);
    }

    public function edit($id)
    {
        $salidas = RegistrosSalidas::find($id);
        $lugares = Lugares::all();
        $estados = EstadosSalidas::all();
        $usuarios = User::all();
        return view('edit-registros-salidas', ['salidas'=> $salidas, 'lugares' => $lugares, 'estados' => $estados, 'usuarios' => $usuarios]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_lugar' => 'required',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_final' => 'required',
            'objetivo' => 'required|min:5'
        ]);

        $comprobar = $this->comprobarHoras($request->hora_inicio, $request->hora_final);

        if ($comprobar == "errorHora") {
            return redirect()->route('registros-salida.index')->with('errorHora', 'La hora de inicio no puede ser mayor que la hora de fin.')->withInput();
        }

        $salidas = new RegistrosSalidas();
        $salidas->id_lugar = $request->id_lugar;
        $salidas->id_usuario = Auth::user()->id;
        $salidas->id_estado = 1;
        $salidas->fecha = $request->fecha;
        $salidas->hora_inicio = $request->hora_inicio;
        $salidas->hora_final = $request->hora_final;
        $salidas->objetivo = $request->objetivo;

        $salidas->save();

        return redirect()->route('registros-salida.index')->with('success', 'Registro de salida guardada correctamente.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'id_lugar' => 'required',
            'id_estado' => 'required',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_final' => 'required',
            'objetivo' => 'required|min:5'
        ]);

        $comprobar = $this->comprobarHoras($request->hora_inicio, $request->hora_final);

        if ($comprobar == "errorHora") {
            return redirect()->route('registros-salida.edit' , ['registros_salida' => $id])->with('errorHora', 'La hora de inicio no puede ser mayor que la hora de fin.')->withInput();
        }

        $salidas = RegistrosSalidas::find($id);
        $salidas->id_lugar = $request->id_lugar;
        $salidas->id_estado = $request->id_estado;
        $salidas->fecha = $request->fecha;
        $salidas->hora_inicio = $request->hora_inicio;
        $salidas->hora_final = $request->hora_final;
        $salidas->objetivo = $request->objetivo;
        $salidas->save();

        return redirect()->route('registros-salida.index')->with('success', 'Registro de salida actualizada correctamente');
    }

    public function destroy($id)
    {
        RegistrosSalidas::destroy($id);
        return redirect()->route('registros-salida.index')->with('success', 'Registro de salida eliminada correctamente'); 
    }
}