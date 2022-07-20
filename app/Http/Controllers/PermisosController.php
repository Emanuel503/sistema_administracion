<?php

namespace App\Http\Controllers;

use App\Models\Coordinadores;
use App\Models\Dependencias;
use App\Models\EstadosPermisos;
use App\Models\Lugares;
use App\Models\MotivosPermisos;
use App\Models\Permisos;
use App\Models\TiposPermisos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermisosController extends Controller
{
    public function index()
    {
        $permisos = Permisos::all();
        $usuarios = User::all();
        $coordinadores = Coordinadores::all();
        $dependencias = Dependencias::all();
        $estados = EstadosPermisos::all();
        $motivos = MotivosPermisos::all();
        $tipos = TiposPermisos::all();

        return view('permisos.index-permisos', [
            'permisos' => $permisos, 'usuarios' => $usuarios, 'dependencias' => $dependencias,
            'estados' => $estados, 'motivos' => $motivos, 'tipos' => $tipos, 'coordinadores' => $coordinadores
        ]);
    }

    public function show($id)
    {
        $permisos = Permisos::find($id);
        return view('permisos.show-permiso', ['permisos' => $permisos]);
    }

    public function edit($id)
    {
        $permisos = Permisos::find($id);
        $usuarios = User::all();
        $coordinadores = DB::select("SELECT u.nombres, u.apellidos, c.id, c.id_tecnico FROM coordinadores c INNER JOIN users u ON u.id = c.id_tecnico");
        $dependencias = Dependencias::all();
        $estados = EstadosPermisos::all();
        $motivos = MotivosPermisos::all();
        $tipos = TiposPermisos::all();

        return view('permisos.edit-permiso', [
            'permisos' => $permisos, 'usuarios' => $usuarios, 'coordinadores' => $coordinadores,
            'dependencias' => $dependencias, 'estados' => $estados, 'motivos' => $motivos, 'tipos' => $tipos
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'dependencia' => 'required',
            'licencia' => 'required',
            'motivo' => 'required',
            'usuario_autoriza' => 'required',
            'fecha_entrada' => 'required',
            'hora_entrada' => 'required',
            'fecha_salida' => 'required',
            'hora_salida' => 'required',
            'fecha_permiso' => 'required',
            'tiempo_dia' => 'required',
            'tiempo_horas' => 'required',
            'tiempo_minutos' => 'required'
        ]);

        $permiso = new Permisos();

        $permiso->id_usuario = $request->usuario;
        $permiso->id_dependencia = $request->dependencia;
        $permiso->id_licencia = $request->licencia;
        $permiso->id_motivo = $request->motivo;
        $permiso->id_usuario_autoriza = $request->usuario_autoriza;
        $permiso->id_estado = 3;
        $permiso->id_usuario_adiciono = Auth::user()->id;

        $permiso->fecha_entrada = $request->fecha_entrada;
        $permiso->hora_entrada = $request->hora_entrada;
        $permiso->fecha_salida = $request->fecha_salida;
        $permiso->hora_salida = $request->hora_salida;
        $permiso->fecha_permiso = $request->fecha_permiso;

        $permiso->tiempo_dia = $request->tiempo_dia;
        $permiso->tiempo_horas = $request->tiempo_horas;
        $permiso->tiempo_minutos = $request->tiempo_minutos;

        $permiso->save();

        return redirect()->route('permisos.index')->with('success', 'Permiso guardado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'usuario' => 'required',
            'dependencia' => 'required',
            'licencia' => 'required',
            'motivo' => 'required',
            'usuario_autoriza' => 'required',
            'fecha_entrada' => 'required',
            'hora_entrada' => 'required',
            'fecha_salida' => 'required',
            'hora_salida' => 'required',
            'fecha_permiso' => 'required',
            'tiempo_dia' => 'required',
            'tiempo_horas' => 'required',
            'tiempo_minutos' => 'required'
        ]);

        $permiso = Permisos::find($id);

        $permiso->id_usuario = $request->usuario;
        $permiso->id_dependencia = $request->dependencia;
        $permiso->id_licencia = $request->licencia;
        $permiso->id_motivo = $request->motivo;
        $permiso->id_usuario_autoriza = $request->usuario_autoriza;
        $permiso->id_estado = $request->estado;
        $permiso->id_usuario_adiciono = Auth::user()->id;

        $permiso->fecha_entrada = $request->fecha_entrada;
        $permiso->hora_entrada = $request->hora_entrada;
        $permiso->fecha_salida = $request->fecha_salida;
        $permiso->hora_salida = $request->hora_salida;
        $permiso->fecha_permiso = $request->fecha_permiso;

        $permiso->tiempo_dia = $request->tiempo_dia;
        $permiso->tiempo_horas = $request->tiempo_horas;
        $permiso->tiempo_minutos = $request->tiempo_minutos;

        $permiso->save();

        return redirect()->route('permisos.index')->with('success', 'Permiso modificado correctamente');
    }

    public function destroy($id)
    {
        Permisos::destroy($id);
        return redirect()->route('permisos.index')->with('success', 'Permiso eliminada correctamente');
    }
}
