<?php

namespace App\Http\Controllers;

use App\Models\Departamentos;
use App\Models\Lugares;
use App\Models\Municipios;
use Illuminate\Http\Request;
use Exception;

class LugaresController extends Controller
{
    public function index()
    {
        $lugares = Lugares::all();
        $departamentos = Departamentos::all();
        $municipios = Municipios::all();
        return view('lugares.index-lugares', ['lugares' => $lugares, 'departamentos' => $departamentos, 'municipios' => $municipios]);
    }

    public function show($id)
    {
        $lugares = Lugares::find($id);
        $departamentos = Departamentos::all();
        $municipios = Municipios::all();
        return view('lugares.show-lugar', ['lugares' => $lugares, 'departamentos' => $departamentos, 'municipios' => $municipios]);
    }

    public function edit($id)
    {
        $lugares = Lugares::find($id);
        $departamentos = Departamentos::all();
        $municipios = Municipios::all();
        return view('lugares.edit-lugar', ['lugares' => $lugares, 'departamentos' => $departamentos, 'municipios' => $municipios]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3',
            'codigo' => 'required|numeric|unique:lugares,codigo,',
            'id_departamento' => 'required',
            'id_municipio' => 'required',
        ]);

        $lugar = new Lugares();
        $lugar->nombre = $request->nombre;
        $lugar->codigo = $request->codigo;
        $lugar->id_departamento = $request->id_departamento;
        $lugar->id_municipio = $request->id_municipio;

        $lugar->save();

        return redirect()->route('lugares.index')->with('success', 'Lugar guardado correctamente.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3',
            'codigo' => 'required|numeric|unique:lugares,codigo, ' . $id,
            'id_departamento' => 'required',
            'id_municipio' => 'required',
        ]);

        $lugar = Lugares::find($id);
        $lugar->nombre = $request->nombre;
        $lugar->codigo = $request->codigo;
        $lugar->id_departamento = $request->id_departamento;
        $lugar->id_municipio = $request->id_municipio;

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