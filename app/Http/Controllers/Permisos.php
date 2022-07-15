<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permisos;

class Permisos extends Controller
{
    public function index(){

        $permisos = Permisos::all();

        return view('permisos.index-permisos', ['permisos' => $permisos]);
    }

    public function show($id){

    }

    public function store(Request $request){
        $request->validate();
    }

    public function edit($id){
        
    }

    public function update(Request $request, $id){
        $request->validate();
    }

    public function destroy($id){

    }
}