<?php

namespace App\Http\Controllers;

use App\Models\DependenciasTransporte;
use App\Models\Lugares;
use App\Models\Transporte;
use App\Models\User;
use App\Models\Vehiculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class TransporteController extends Controller
{
    public function comprobarHoras($hora_salida, $hora_destino)
    {
        if (strtotime($hora_destino) <= strtotime($hora_salida)) {
            return "errorHora";
        }
    }

    public function index()
    {
        $transportes = Transporte::all();
        $dependencias = DependenciasTransporte::all();
        $usuarios = User::all();
        $vehiculos = Vehiculos::all();
        $lugares = Lugares::all();

        return view('transporte', ['dependencias' => $dependencias, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos, 'transportes' => $transportes, 'lugares' => $lugares]);
    }

    public function show($id)
    {
        $transportes = Transporte::find($id);
        $dependencia = DependenciasTransporte::all();
        $conductor = User::all();
        $vehiculos = Vehiculos::all();

        return view('show-transporte', ['dependencia' => $dependencia, 'conductor' => $conductor, 'vehiculos' => $vehiculos, 'transportes' => $transportes]);
    }

    public function edit($id)
    {
        $transportes = Transporte::find($id);
        $dependencias = DependenciasTransporte::all();
        $usuarios = User::all();
        $vehiculos = Vehiculos::all();
        $lugares = Lugares::all();

        return view('edit-transporte', ['transportes' => $transportes, 'dependencias' => $dependencias, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos, 'lugares' => $lugares]);
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
            'combustible' => 'required',
            'tipo_combustible' => 'required',
            'pasajero' => 'required'
        ]);

        $validacionKm = DB::select(
            "SELECT * FROM vehiculos WHERE id = ?",
            [$request->id_placa]
        );

        foreach ($validacionKm as $val) {
            if ($request->km_salida < $val->kilometraje) {
                return redirect()->route('transporte.index')->with('errorHora', 'El kilometraje ingresado es menor al ultimo registrado.');
            }
        }

        if ($request->km_destino < $request->km_salida) {
            return redirect()->route('transporte.index')->with('errorHora', 'El kilometraje de destino no puede ser menor al kilometraje de salida.');
        }

        $comprobar = $this->comprobarHoras($request->hora_salida, $request->hora_destino);

        if ($comprobar == "errorHora") {
            return redirect()->route('transporte.index')->with('errorHora', 'La hora de destino no puede ser menor que la hora de salida.');
        }

        $transporte = new Transporte();
        $distancia = $request->km_destino - $request->km_salida;

        $transporte->id_dependencia = $request->id_dependencia;
        $transporte->id_conductor = $request->id_conductor;
        $transporte->id_placa = $request->id_placa;
        $transporte->fecha = $request->fecha;
        //Salida
        $transporte->hora_salida = $request->hora_salida;
        $transporte->km_salida = $request->km_salida;
        $transporte->lugar_salida = $request->lugar_salida;
        //Destino
        $transporte->hora_destino = $request->hora_destino;
        $transporte->km_destino = $request->km_destino;
        $transporte->lugar_destino = $request->lugar_destino;
        //Otros
        $transporte->distancia_recorrida = $distancia;
        $transporte->combustible = $request->combustible;
        $transporte->tipo_combustible = $request->tipo_combustible;
        $transporte->pasajero = $request->pasajero;

        $transporte->save();
        DB::update("UPDATE vehiculos SET kilometraje= ? WHERE id = ?", [$request->km_destino, $request->id_placa]);

        return redirect()->route('transporte.index')->with('success', 'Transporte guardado correctamente.');
    }

    public function update($id, Request $request)
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
            'combustible' => 'required',
            'tipo_combustible' => 'required',
            'pasajero' => 'required'
        ]);

        DB::update("UPDATE vehiculos SET kilometraje= ? WHERE id = ?", [$request->km_salida, $request->id_placa]);

        $validacionKm = DB::select(
            "SELECT * FROM vehiculos WHERE id = ?",
            [$request->id_placa]
        );

        foreach ($validacionKm as $val) {
            if ($request->km_salida < $val->kilometraje) {
                return redirect()->route('transporte.index')->with('errorHora', 'El kilometraje ingresado es menor al ultimo registrado.');
            }
        }

        if ($request->km_destino < $request->km_salida) {
            return redirect()->route('transporte.index')->with('errorHora', 'El kilometraje de destino no puede ser menor al kilometraje de salida.');
        }

        $comprobar = $this->comprobarHoras($request->hora_salida, $request->hora_destino);

        if ($comprobar == "errorHora") {
            return redirect()->route('transporte.index')->with('errorHora', 'La hora de destino no puede ser menor que la hora de salida.');
        }

        $transporte = Transporte::find($id);

        $distancia = $request->km_destino - $request->km_salida;

        $transporte->id_dependencia = $request->id_dependencia;
        $transporte->id_conductor = $request->id_conductor;
        $transporte->id_placa = $request->id_placa;
        $transporte->fecha = $request->fecha;
        //Salida
        $transporte->hora_salida = $request->hora_salida;
        $transporte->km_salida = $request->km_salida;
        $transporte->lugar_salida = $request->lugar_salida;
        //Destino
        $transporte->hora_destino = $request->hora_destino;
        $transporte->km_destino = $request->km_destino;
        $transporte->lugar_destino = $request->lugar_destino;
        //Otros
        $transporte->distancia_recorrida = $distancia;
        $transporte->combustible = $request->combustible;
        $transporte->tipo_combustible = $request->tipo_combustible;
        $transporte->pasajero = $request->pasajero;

        $transporte->save();
        DB::update("UPDATE vehiculos SET kilometraje= ? WHERE id = ?", [$request->km_destino, $request->id_placa]);

        return redirect()->route('transporte.index')->with('success', 'Transporte actualizado correctamente');
    }

    public function destroy($id)
    {
        Transporte::destroy($id);
        return redirect()->route('transporte.index')->with('success', 'Transporte eliminada correctamente');
    }
}
