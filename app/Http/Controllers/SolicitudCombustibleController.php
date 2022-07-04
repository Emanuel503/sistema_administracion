<?php

namespace App\Http\Controllers;

use App\Models\Lugares;
use App\Models\SolicitudCombustible;
use App\Models\User;
use App\Models\Vehiculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitudCombustibleController extends Controller
{
    public function index()
    {
        $solicitudes = SolicitudCombustible::all();
        $usuarios = User::all();
        $vehiculos = Vehiculos::all();
        $lugares = Lugares::all();

        return view('solicitud-combustible.index-solicitud-combustible', ['solicitudes' => $solicitudes, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos, 'lugares' => $lugares]);
    }

    public function show($id)
    {
        $solicitudes = SolicitudCombustible::find($id);
        $usuarios = User::all();
        $vehiculos = Vehiculos::all();
        $lugares = Lugares::all();

        return view('solicitud-combustible.show-solicitud-combustible', ['solicitudes' => $solicitudes, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos, 'lugares' => $lugares]);
    }

    public function edit($id)
    {
        $solicitudes = SolicitudCombustible::find($id);
        $usuarios = User::all();
        $vehiculos = Vehiculos::all();
        $lugares = Lugares::all();

        return view('solicitud-combustible.edit-solicitud-combustible', ['solicitudes' => $solicitudes, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos, 'lugares' => $lugares]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_destinatario' => 'required',
            'id_origen' => 'required',
            'fecha_solicitud' => 'required|date',
            'id_vehiculo' => 'required',
            'id_conductor' => 'required',
            'lugar_destino' => 'required',
            'fecha_detalle' => 'required|date',
            'hora_salida' => 'required',
            'objetivo' => 'required|min:5',
            'tipo_combustible' => 'required',
            'cantidad_combustible' => 'required|numeric|min:0'
        ]);

        $solicitud = new SolicitudCombustible();

        $km = DB::select("SELECT * FROM vehiculos WHERE id = ?", [$request->id_vehiculo]);

        $solicitud->id_destinatario = $request->id_destinatario;
        $solicitud->id_origen = $request->id_origen;
        $solicitud->fecha_solicitud = $request->fecha_solicitud;
        $solicitud->id_vehiculo = $request->id_vehiculo;
        $solicitud->id_conductor = $request->id_conductor;
        $solicitud->lugar_destino = $request->lugar_destino;
        $solicitud->fecha_detalle = $request->fecha_detalle;
        $solicitud->hora_salida = $request->hora_salida;
        $solicitud->objetivo = $request->objetivo;
        $solicitud->tipo_combustible = $request->tipo_combustible;
        $solicitud->cantidad_combustible = $request->cantidad_combustible;

        foreach ($km  as $k) {
            $kilometraje = $k->kilometraje;
        }

        $solicitud->kilometraje = $kilometraje;

        $solicitud->save();

        return redirect()->route('solicitud-combustible.index')->with('success', 'Solicitud guardada correctamente.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'id_destinatario' => 'required',
            'id_origen' => 'required',
            'fecha_solicitud' => 'required|date',
            'id_vehiculo' => 'required',
            'id_conductor' => 'required',
            'lugar_destino' => 'required',
            'fecha_detalle' => 'required|date',
            'hora_salida' => 'required',
            'objetivo' => 'required|min:5',
            'tipo_combustible' => 'required',
            'cantidad_combustible' => 'required|numeric|min:0'
        ]);

        $solicitud = SolicitudCombustible::find($id);

        $km = DB::select("SELECT * FROM vehiculos WHERE id = ?", [$request->id_vehiculo]);

        $solicitud->id_destinatario = $request->id_destinatario;
        $solicitud->id_origen = $request->id_origen;
        $solicitud->fecha_solicitud = $request->fecha_solicitud;
        $solicitud->id_vehiculo = $request->id_vehiculo;
        $solicitud->id_conductor = $request->id_conductor;
        $solicitud->lugar_destino = $request->lugar_destino;
        $solicitud->fecha_detalle = $request->fecha_detalle;
        $solicitud->hora_salida = $request->hora_salida;
        $solicitud->objetivo = $request->objetivo;
        $solicitud->tipo_combustible = $request->tipo_combustible;
        $solicitud->cantidad_combustible = $request->cantidad_combustible;

        foreach ($km  as $k) {
            if ($request->id_vehiculo != $k->id) {
                $kilometraje = $k->kilometraje;
                $solicitud->kilometraje = $kilometraje;
            }
        }

        $solicitud->save();

        return redirect()->route('solicitud-combustible.index')->with('success', 'Solicitud actualizada correctamente');
    }

    public function destroy($id)
    {
        SolicitudCombustible::destroy($id);
        return redirect()->route('solicitud-combustible.index')->with('success', 'Solicitud eliminada correctamente');
    }
}