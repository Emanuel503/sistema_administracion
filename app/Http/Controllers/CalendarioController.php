<?php

namespace App\Http\Controllers;

use App\Models\Actividades;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function calendar()
    {
        $actividades = Actividades::all();
        return response()->json($actividades);
    }

    public function edit($id)
    {
        $actividades = Actividades::find($id);
        return response()->json($actividades);
    }
}
