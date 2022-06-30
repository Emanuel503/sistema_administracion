<?php

namespace App\Http\Controllers;

use App\Models\Vehiculos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiculosController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculos::all();
        return view('vehiculos', ['vehiculos' => $vehiculos]);
    }

    public function show($id)
    {
        $vehiculos = Vehiculos::find($id);
        return view('show-vehiculos', ['vehiculos' => $vehiculos]);
    }

    public function edit($id)
    {
        $vehiculos = Vehiculos::find($id);
        return view('edit-vehiculos', ['vehiculos' => $vehiculos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|unique:vehiculos,placa',
            'km' => 'required'
        ]);

        $vehiculos = new Vehiculos();
        $vehiculos->placa = $request->placa;
        $vehiculos->kilometraje = $request->km;

        $vehiculos->save();

        return redirect()->route('vehiculos.index')->with('success', 'Vehiculo guardado correctamente.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'placa' => 'required|unique:vehiculos,placa,' . $id,
            'km' => 'required'
        ]);

        $placas = Vehiculos::find($id);
        $placas->placa = $request->placa;
        $placas->kilometraje = $request->km;
        $placas->save();

        return redirect()->route('vehiculos.index')->with('success', 'Vehiculo actualizado correctamente');
    }

    public function destroy($id)
    {
        try {
            Vehiculos::destroy($id);
            return redirect()->route('vehiculos.index')->with('success', 'Vehiculo eliminado correctamente');
        } catch (Exception $e) {
            return redirect()->route('vehiculos.index')->with('errorEliminar', 'No se puede eliminar el vehiculo, ya contiene registros');
        }
    }
}
