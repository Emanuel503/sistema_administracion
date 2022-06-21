<?php

namespace App\Http\Controllers;

use App\Models\Salas;
use Illuminate\Http\Request;

class SalasController extends Controller
{
    public function index(){
        $salas = Salas::all();
        return view('solicitudes-salas',['salas' => $salas]);
    }
}
