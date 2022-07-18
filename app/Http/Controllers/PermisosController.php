<?php

namespace App\Http\Controllers;

use App\Models\Permisos;
use Illuminate\Http\Request;

class PermisosController extends Controller
{
    public function index(){
        $permisos = Permisos::all();
        return view('permisos.index-permisos', ['permisos' => $permisos]);
    }

    public function show($id){
        $permisos = Permisos::find($id);
        return view('permisos.show-permiso', ['permisos' => $permisos]);
    }

    public function edit($id){
        $permisos = Permisos::find($id);
        return view('permisos.edit-permiso', ['permisos' => $permisos]);
    }

    public function store(Request $request){
        $request->validate();

        return redirect()->route('permisos.index')->with('success', 'Permiso guardado correctamente');
    }

    public function update(Request $request, $id){
        $request->validate();

        return redirect()->route('permisos.index')->with('success', 'Permiso modificado correctamente');
    }

    public function destroy($id){
        Permisos::destroy($id);
        return redirect()->route('permisos.index')->with('success', 'Permiso eliminada correctamente');
    }
}