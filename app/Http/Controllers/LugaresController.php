<?php

namespace App\Http\Controllers;

use App\Models\Lugares;
use Illuminate\Http\Request;
use Exception;

class LugaresController extends Controller
{
    public function index()
    {
        $lugares = Lugares::all();
        return view('lugares', ['lugares' => $lugares]);
    }

    public function show($id)
    {
        $lugares = Lugares::find($id);
        return view('show-lugar', ['lugares' => $lugares]);
    }

    public function edit($id)
    {
        $lugares = Lugares::find($id);
        return view('edit-lugar', ['lugares' => $lugares]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3',
            'codigo' => 'required|numeric|unique:lugares,codigo,'
        ]);

        $lugar = new Lugares();
        $lugar->nombre = $request->nombre;
        $lugar->codigo = $request->codigo;

        $lugar->save();

        return redirect()->route('lugares.index')->with('success', 'Lugar guardado correctamente.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3',
            'codigo' => 'required|numeric|unique:lugares,codigo, ' . $id,
        ]);

        $lugar = Lugares::find($id);
        $lugar->nombre = $request->nombre;
        $lugar->codigo = $request->codigo;
        $lugar->save();

        return redirect()->route('lugares.index')->with('success', 'Lugar actualizado correctamente');
    }

    public function destroy($id)
    {
        try {
            Lugares::destroy($id);
            return redirect()->route('lugares.index')->with('success', 'Lugar eliminado correctamente');
        } catch (Exception $e) {
            return redirect()->route('lugares.index')->with('errorEliminar', 'No se puede eliminar el lugar, ya contiene registros');
        }
    }
}
