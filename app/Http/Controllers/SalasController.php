<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalasController extends Controller
{
    //
    public function index()
    {
        $salas = Sala::all();

        return view('sala', ['salas' => $salas]);
    }

    public function show($id)
    {
        $salas = Sala::find($id);

        return view('show-sala', ['salas' => $salas]);
    }

    public function edit($id)
    {
        $salas = Sala::find($id);

        return view('edit-sala', ['salas' => $salas]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sala' => 'required'
        ]);


        $sala = new Sala();
        $sala->sala = $request->sala;

        $sala->save();

        return redirect()->route('salas.index')->with('success', 'Sala guardada correctamente.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'sala' => 'required'
        ]);

        $sala = Sala::find($id);
        $sala->sala = $request->sala;

        $sala->save();

        return redirect()->route('salas.index')->with('success', 'Sala actualizada correctamente');
    }

    public function destroy($id)
    {
        Sala::destroy($id);
        return redirect()->route('salas.index')->with('success', 'Sala eliminada correctamente');
    }
}
