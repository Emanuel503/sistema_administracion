<?php

namespace App\Http\Controllers;

use App\Models\Vehiculos;
use Exception;
use Illuminate\Http\Request;

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
            'placa' => 'required',
            'km' => 'required'
        ]);

        $vehiculos = new Vehiculos();
        $vehiculos->placa = $request->placa;
        $vehiculos->kilometraje = $request->km;

        $vehiculos->save();

        return redirect()->route('vehiculos.index')->with('success', 'Número de placa
        guardada correctamente.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'placa' => 'required'
        ]);

        $placas = Vehiculos::find($id);
        $placas->placa = $request->placa;
        $placas->save();

        return redirect()->route('vehiculos.index')->with('success', 'Número de placa actualizada correctamente');
    }

    public function destroy($id)
    {
        try {
            Vehiculos::destroy($id);
            return redirect()->route('vehiculos.index')->with('success', 'Número de placa eliminada correctamente');
        } catch (Exception $e) {
            return redirect()->route('vehiculos.index')->with('errorEliminar', 'No se puede eliminar el número de placa, ya contiene registros');
        }
    }
}