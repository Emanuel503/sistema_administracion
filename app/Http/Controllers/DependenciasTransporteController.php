<?php

namespace App\Http\Controllers;

use App\Models\DependenciasTransporte;
use Illuminate\Http\Request;
use Exception;

class DependenciasTransporteController extends Controller
{
    public function index()
    {
        $dependencias = DependenciasTransporte::all();
        return view('dependencias-transporte', ['dependencias' => $dependencias]);
    }

    public function show($id)
    {
        $dependencias = DependenciasTransporte::find($id);
        return view('show-dependencias-transporte', ['dependencias' => $dependencias]);
    }

    public function edit($id)
    {
        $dependencias = DependenciasTransporte::find($id);
        return view('edit-dependencias-transporte', ['dependencias' => $dependencias]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:2',
        ]);

        $dependencias = new DependenciasTransporte;
        $dependencias->nombre = $request->nombre;
        $dependencias->save();

        return redirect()->route('dependencias-transporte.index')->with('success', 'Dependencia guardada correctamente');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:2',
        ]);

        $dependencias = DependenciasTransporte::find($id);
        $dependencias->nombre = $request->nombre;
        $dependencias->save();

        return redirect()->route('dependencias-transporte.index')->with('success', 'Dependencia actualizada correctamente');
    }

    public function destroy($id)
    {
        try {
            DependenciasTransporte::destroy($id);
            return redirect()->route('dependencias-transporte.index')->with('success', 'Dependencia eliminada correctamente');
        } catch (Exception $e) {
            return redirect()->route('dependencias-transporte.index')->with('errorEliminar', 'No se puede eliminar la dependencia, ya contiene registros');
        }
    }
}
