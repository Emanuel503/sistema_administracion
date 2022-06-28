<?php

namespace App\Http\Controllers;

use App\Models\Autorizaciones;
use App\Models\DependenciasTransporte;
use App\Models\Lugares;
use App\Models\SolicitudesTransportes;
use App\Models\User;
use Illuminate\Http\Request;

class SolicitudesTransporteController extends Controller
{
    public function index(){
        $solicitudesTransportes = SolicitudesTransportes::all();
        $dependencias = DependenciasTransporte::all();
        $lugares = Lugares::all();
        $autorizaciones = Autorizaciones::all();
        $usuarios = User::all();
        //return view('solicitudes-transportes', ['solicitudesTransportes' => $solicitudesTransportes, 'dependencias' => $dependencias, , 'lugares' => $lugares, 'autorizaciones' => $autorizaciones, 'usuarios' => $usuarios]);
    }

    public function show($id){

    }

    public function store(Request $request){

    }

    public function edit($id){

    }

    public function update($id, Request $request){

    }

    public function destoy($id){

    }
}