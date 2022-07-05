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

    public function actividad($id)
    {
        $actividades = Actividades::find($id);
        return response()->json($actividades);
    }

    public function salida($id)
    {
        $salidas = RegistrosSalidas::find($id);
        return response()->json($salidas);
    }
}