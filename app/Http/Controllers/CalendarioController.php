<?php

namespace App\Http\Controllers;

use App\Models\Actividades;
use App\Models\RegistrosSalidas;

class CalendarioController extends Controller
{
    public function calendar()
    {
        $actividades = Actividades::all();
        $registro_salidas = RegistrosSalidas::all();
        $datos = $actividades->concat($registro_salidas);
        return response()->json($datos);
    }

    public function edit($id)
    {
        $actividades = Actividades::find($id);
        return response()->json($actividades);
    }
}