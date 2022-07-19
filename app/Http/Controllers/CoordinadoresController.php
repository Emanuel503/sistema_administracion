<?php

namespace App\Http\Controllers;

use App\Models\Coordinadores;
use App\Models\TiposCoordinaciones;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoordinadoresController extends Controller
{
    public function index()
    {
        $coordinadores = Coordinadores::all();
        $usuarios = User::all();
        $coordinaciones = TiposCoordinaciones::all();

        return view('coordinadores.index-coordinadores', ['coordinadores' => $coordinadores, 'usuarios' => $usuarios, 'coordinaciones' => $coordinaciones]);
    }

    public function show($id)
    {
        $coordinadores = Coordinadores::find($id);
        $usuarios = User::all();
        $coordinaciones = TiposCoordinaciones::all();

        return view('coordinadores.show-coordinadores', ['coordinadores' => $coordinadores, 'usuarios' => $usuarios, 'coordinaciones' => $coordinaciones]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'tipo_coordinacion' => 'required'
        ]);

        $coordinadores = new Coordinadores();
        $coordinadores->id_tecnico = $request->usuario;
        $coordinadores->id_coordinacion = $request->tipo_coordinacion;

        $coordinadores->save();

        return redirect()->route('coordinadores.index')->with('success', 'Coordinador guardado correctamente.');
    }

    public function edit($id)
    {
        $coordinadores = Coordinadores::find($id);
        $usuarios = User::all();
        $coordinaciones = TiposCoordinaciones::all();

        return view('coordinadores.edit-coordinadores', ['coordinadores' => $coordinadores, 'usuarios' => $usuarios, 'coordinaciones' => $coordinaciones]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'tipo_coordinacion' => 'required'
        ]);

        $coordinadores = Coordinadores::find($id);
        $coordinadores->id_tecnico = $request->usuario;
        $coordinadores->id_coordinacion = $request->tipo_coordinacion;
        $coordinadores->save();

        return redirect()->route('coordinadores.index')->with('success', 'Coordinador actualizado correctamente.');
    }

    public function destroy($id)
    {
        Coordinadores::destroy($id);
        return redirect()->route('coordinadores.index')->with('success', 'Coordinador eliminado correctamente');
    }
}
