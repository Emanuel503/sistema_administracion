<?php

namespace App\Http\Controllers;

use App\Models\PlacasVehiculos;
use Illuminate\Http\Request;
use Exception;

class PlacasVehiculosController extends Controller
{
    public function index()
    {
        $placas = PlacasVehiculos::all();
        return view('placas-vehiculos', ['placas' => $placas]);
    }

    public function show($id)
    {
        $placas = PlacasVehiculos::find($id);
        return view('show-placas-vehiculos', ['placas' => $placas]);
    }

    public function edit($id)
    {
        $placas = PlacasVehiculos::find($id);
        return view('edit-placas-vehiculos', ['placas' => $placas]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required'
        ]);

        $placas = new PlacasVehiculos();
        $placas->placa = $request->placa;

        $placas->save();

        return redirect()->route('placas-vehiculos.index')->with('success', 'Nímero de placa
        guardada correctamente.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'placa' => 'required'
        ]);

        $placas = PlacasVehiculos::find($id);
        $placas->placa = $request->placa;
        $placas->save();

        return redirect()->route('placas-vehiculos.index')->with('success', 'Número de placa actualizada correctamente');
    }

    public function destroy($id)
    {
        try {
            PlacasVehiculos::destroy($id);
            return redirect()->route('placas-vehiculos.index')->with('success', 'Número de placa eliminada correctamente');
        } catch (Exception $e) {
            return redirect()->route('placas-vehiculos.index')->with('errorEliminar', 'No se puede eliminar el número de placa, ya contiene registros');
        }
    }
}
