<?php

namespace App\Http\Controllers;

use App\Models\Dependencias;
use Illuminate\Http\Request;
use Exception;

class DependenciasController extends Controller
{
    public function index()
    {
        $dependencias = Dependencias::all();
        return view('dependencias.index-dependencias', ['dependencias' => $dependencias]);
    }

    public function show($id)
    {
        $dependencias = Dependencias::find($id);
        return view('dependencias.show-dependencias', ['dependencias' => $dependencias]);
    }

    public function edit($id)
    {
        $dependencias = Dependencias::find($id);
        return view('dependencias.edit-dependencias', ['dependencias' => $dependencias]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:2',
        ]);

        $dependencias = new Dependencias;
        $dependencias->nombre = $request->nombre;
        $dependencias->save();

        return redirect()->route('dependencias.index')->with('success', 'Dependencia guardada correctamente');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:2',
        ]);

        $dependencias = Dependencias::find($id);
        $dependencias->nombre = $request->nombre;
        $dependencias->save();

        return redirect()->route('dependencias.index')->with('success', 'Dependencia actualizada correctamente');
    }

    public function destroy($id)
    {
        try {
            Dependencias::destroy($id);
            return redirect()->route('dependencias.index')->with('success', 'Dependencia eliminada correctamente');
        } catch (Exception $e) {
            return redirect()->route('dependencias.index')->with('errorEliminar', 'No se puede eliminar la dependencia, ya contiene registros');
        }
    }
}
