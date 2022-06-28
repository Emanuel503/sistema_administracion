<?php

namespace App\Http\Controllers;

use App\Models\DependenciasTransporte;
use App\Models\Lugares;
use App\Models\PlacasVehiculos;
use App\Models\Transporte;
use App\Models\User;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class TransporteController extends Controller
{
    public function index()
    {
        $transportes = Transporte::all();
        $dependencias = DependenciasTransporte::all();
        $usuarios = User::all();
        $placas = PlacasVehiculos::all();
        $lugares = Lugares::all();

        return view('transporte', ['dependencias' => $dependencias, 'usuarios' => $usuarios, 'placas' => $placas, 'transportes' => $transportes, 'lugares' => $lugares]);
    }

    public function show($id)
    {
        $transportes = Transporte::find($id);
        $dependencia = DependenciasTransporte::all();
        $conductor = User::all();
        $placa = PlacasVehiculos::all();

        return view('show-transporte', ['dependencia' => $dependencia, 'conductor' => $conductor, 'placa' => $placa, 'transportes' => $transportes]);
    }

    public function edit($id)
    {
        $transportes = Transporte::find($id);
        $dependencias = DependenciasTransporte::all();
        $usuarios = User::all();
        $placas = PlacasVehiculos::all();
        $lugares = Lugares::all();

        return view('edit-transporte', ['transportes' => $transportes, 'dependencias' => $dependencias, 'usuarios' => $usuarios, 'placas' => $placas, 'lugares' => $lugares]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_dependencia' => 'required',
            'id_conductor' => 'required',
            'id_placa' => 'required',
            'fecha' => 'required',
            //Salida
            'hora_salida' => 'required',
            'km_salida' => 'required',
            'lugar_salida' => 'required',
            //Destino
            'hora_destino' => 'required',
            'km_destino' => 'required',
            'lugar_destino' => 'required',
            //Otros
            'distancia_recorrida' => 'required',
            'combustible' => 'required',
            'tipo_combustible' => 'required',
            'pasajero' => 'required'
        ]);

        $transporte = new Transporte();

        $transporte->id_dependencia = $request->id_dependencia;
        $transporte->id_conductor = $request->id_conductor;
        $transporte->id_placa = $request->id_placa;
        $transporte->fecha = $request->fecha;

        $transporte->hora_salida = $request->hora_salida;
        $transporte->km_salida = $request->km_salida;
        $transporte->lugar_salida = $request->lugar_salida;

        $transporte->hora_destino = $request->hora_destino;
        $transporte->km_destino = $request->km_destino;
        $transporte->lugar_destino = $request->lugar_destino;

        $transporte->distancia_recorrida = $request->distancia_recorrida;
        $transporte->combustible = $request->combustible;
        $transporte->tipo_combustible = $request->tipo_combustible;
        $transporte->pasajero = $request->pasajero;

        $transporte->save();

        return redirect()->route('transporte.index')->with('success', 'Transporte guardado correctamente.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'id_dependencia' => 'required',
            'id_conductor' => 'required',
            'id_placa' => 'required',
            'fecha' => 'required|date',
            //Salida
            'hora_salida' => 'required|time',
            'km_salida' => 'required',
            'lugar_salida' => 'required',
            //Destino
            'hora_destino' => 'required|time',
            'km_destino' => 'required',
            'lugar_destino' => 'required',
            //Otros
            'distancia_recorrida' => 'required',
            'combustible' => 'required',
            'tipo_combustible' => 'required',
            'pasajero' => 'required'
        ]);

        $comprobar = $this->comprobarHorario($request->fecha_inicio, $request->fecha_finalizacion, $request->hora_inicio, $request->hora_finalizacion);

        if ($comprobar == "errorHora") {
            return redirect()->route('actividades.index')->with('errorHora', 'La hora de incio no puede ser mayor o igual a la hora de finalizacion');
        }

        if ($comprobar == "errorFecha") {
            return redirect()->route('actividades.index')->with('errorFecha', 'La fecha de incio no puede ser mayor a la fecha de finalizacion');
        }

        $transporte = Transporte::find($id);

        $transporte->id_dependencia = $request->id_dependencia;
        $transporte->id_conductor = $request->id_conductor;
        $transporte->id_placa = $request->id_placa;
        $transporte->fecha = $request->fecha;

        $transporte->hora_salida = $request->hora_salida;
        $transporte->km_salida = $request->km_salida;
        $transporte->lugar_salida = $request->lugar_salida;

        $transporte->hora_destino = $request->hora_destino;
        $transporte->km_destino = $request->km_destino;
        $transporte->lugar_destino = $request->lugar_destino;

        $transporte->distancia_recorrida = $request->distancia_recorrida;
        $transporte->combustible = $request->combustible;
        $transporte->tipo_combustible = $request->tipo_combustible;
        $transporte->pasajero = $request->pasajero;

        $transporte->save();

        return redirect()->route('transporte.index')->with('success', 'Transporte actualizado correctamente');
    }

    public function destroy($id)
    {
        Transporte::destroy($id);
        return redirect()->route('transporte.index')->with('success', 'Transporte eliminada correctamente');
    }
}
