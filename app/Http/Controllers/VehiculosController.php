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
        return view('vehiculos.index-vehiculos', ['vehiculos' => $vehiculos]);
    }

    public function show($id)
    {
        $vehiculos = Vehiculos::find($id);
        return view('vehiculos.show-vehiculos', ['vehiculos' => $vehiculos]);
    }

    public function edit($id)
    {
        $vehiculos = Vehiculos::find($id);
        return view('vehiculos.edit-vehiculos', ['vehiculos' => $vehiculos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|unique:vehiculos,placa',
            'marca' => 'required|min:2',
            'modelo' => 'required|min:2',
            'color' => 'required|min:2',
            'year' => 'required|numeric|min:1000',
            'km' => 'required|numeric|min:0',
            'tipo_combustible' => 'required'
        ]);

        $vehiculos = new Vehiculos();
        $vehiculos->placa = $request->placa;
        $vehiculos->marca = $request->marca;
        $vehiculos->modelo = $request->modelo;
        $vehiculos->color = $request->color;
        $vehiculos->year = $request->year;
        $vehiculos->kilometraje = $request->km;
        $vehiculos->tipo_combustible = $request->tipo_combustible;

        $vehiculos->save();

        return redirect()->route('vehiculos.index')->with('success', 'Vehiculo guardado correctamente.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'placa' => 'required|unique:vehiculos,placa,' . $id,
            'marca' => 'required|min:2',
            'modelo' => 'required|min:2',
            'color' => 'required|min:2',
            'year' => 'required|numeric|min:1000',
            'km' => 'required|numeric|min:0',
            'tipo_combustible' => 'required'
        ]);

        $vehiculos = Vehiculos::find($id);
        $vehiculos->placa = $request->placa;
        $vehiculos->marca = $request->marca;
        $vehiculos->modelo = $request->modelo;
        $vehiculos->color = $request->color;
        $vehiculos->year = $request->year;
        $vehiculos->kilometraje = $request->km;
        $vehiculos->tipo_combustible = $request->tipo_combustible;

        $vehiculos->save();

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