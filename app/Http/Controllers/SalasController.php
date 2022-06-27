<?php

namespace App\Http\Controllers;

use App\Models\Salas;
use Exception;
use Illuminate\Http\Request;

class SalasController extends Controller
{
    public function index()
    {
        $salas = Salas::all();
        return view('sala', ['salas' => $salas]);
    }

    public function show($id)
    {
        $salas = Salas::find($id);
        return view('show-sala', ['salas' => $salas]);
    }

    public function edit($id)
    {
        $salas = Salas::find($id);
        return view('edit-sala', ['salas' => $salas]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sala' => 'required'
        ]);

        $sala = new Salas();
        $sala->sala = $request->sala;

        $sala->save();

        return redirect()->route('salas.index')->with('success', 'Sala guardada correctamente.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'sala' => 'required'
        ]);

        $sala = Salas::find($id);
        $sala->sala = $request->sala;
        $sala->save();

        return redirect()->route('salas.index')->with('success', 'Sala actualizada correctamente');
    }

    public function destroy($id)
    {
        try{
            Salas::destroy($id);
            return redirect()->route('salas.index')->with('success', 'Sala eliminada correctamente');
        }catch(Exception $e){
            return redirect()->route('salas.index')->with('errorEliminar', 'No se puede eliminar la sala, ya contiene registros');
        }
    }
}
