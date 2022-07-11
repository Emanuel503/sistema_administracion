<?php

namespace App\Http\Controllers;

use App\Models\DependenciasTransporte;
use App\Models\Lugares;
use App\Models\Transporte;
use App\Models\User;
use App\Models\Vehiculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;    

class TransporteController extends Controller
{

    public function pdf($id){

        $pdf = App::make('dompdf.wrapper');
        $dependencias = DependenciasTransporte::all();
        $usuarios = User::all();
        $vehiculos = Vehiculos::all();
        $lugares = Lugares::all();

        if($id == 0){
            $transportes = Transporte::all();
            $pdf->loadView('transporte.all-pdf', ['dependencias' => $dependencias, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos, 'transportes' => $transportes, 'lugares' => $lugares]);
        }else{
            $transportes = Transporte::find($id);
            $pdf->loadView('transporte.one-pdf', ['dependencias' => $dependencias, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos, 'transportes' => $transportes, 'lugares' => $lugares]);
        }
        return $pdf->stream();
    }

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

        return view('transporte.index-transporte', ['dependencias' => $dependencias, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos, 'transportes' => $transportes, 'lugares' => $lugares]);
    }

    public function show($id)
    {
        $transportes = Transporte::find($id);
        $dependencia = DependenciasTransporte::all();
        $conductor = User::all();
        $vehiculos = Vehiculos::all();

        return view('transporte.show-transporte', ['dependencia' => $dependencia, 'conductor' => $conductor, 'vehiculos' => $vehiculos, 'transportes' => $transportes]);
    }

    public function edit($id)
    {
        $transportes = Transporte::find($id);
        $dependencias = DependenciasTransporte::all();
        $usuarios = User::all();
        $vehiculos = Vehiculos::all();
        $lugares = Lugares::all();

        return view('transporte.edit-transporte', ['transportes' => $transportes, 'dependencias' => $dependencias, 'usuarios' => $usuarios, 'vehiculos' => $vehiculos, 'lugares' => $lugares]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_dependencia' => 'required',
            'id_conductor' => 'required',
            'id_placa' => 'required',
            'fecha' => 'required|date',
            //Salida
            'hora_salida' => 'required',
            'km_salida' => 'required|numeric|min:0',
            'lugar_salida' => 'required',
            //Destino
            'hora_destino' => 'required',
            'km_destino' => 'required|numeric|min:0',
            'lugar_destino' => 'required',
            //Otros            
            'combustible' => 'required|numeric|min:0',
            'tipo_combustible' => 'required',
            'pasajero' => 'required',
            'objetivo' => 'required|min:2'
        ]);

        $validacionKm = DB::select(
            "SELECT * FROM vehiculos WHERE id = ?",
            [$request->id_placa]
        );

        foreach ($validacionKm as $val) {
            if ($request->km_salida < $val->kilometraje) {
                return redirect()->route('transporte.index')->with('errorHora', 'El kilometraje ingresado es menor al ultimo registrado.')->withInput();
            }
        }

        if ($request->km_destino < $request->km_salida) {
            return redirect()->route('transporte.index')->with('errorHora', 'El kilometraje de destino no puede ser menor al kilometraje de salida.')->withInput();
        }

        $comprobar = $this->comprobarHoras($request->hora_salida, $request->hora_destino);

        if ($comprobar == "errorHora") {
            return redirect()->route('transporte.index')->with('errorHora', 'La hora de destino no puede ser menor que la hora de salida.')->withInput();
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
        $transporte->objetivo = $request->objetivo;
       
        $añoActual = date('Y');
        $registros =  DB::select("SELECT correlativo FROM transportes");
        $contador = 0;
        foreach($registros as $registro){
            $numero = explode("-", $registro->correlativo);

            if($añoActual == $numero[0]){
                $contador++;
            }
        }
        $contador++;
        $transporte->correlativo = $añoActual . "-".$contador."-ADMON";

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
            'fecha' => 'required|date',
            //Salida
            'hora_salida' => 'required',
            'km_salida' => 'required|numeric',
            'lugar_salida' => 'required',
            //Destino
            'hora_destino' => 'required',
            'km_destino' => 'required|numeric',
            'lugar_destino' => 'required',
            //Otros
            'combustible' => 'required|numeric|min:0',
            'tipo_combustible' => 'required',
            'pasajero' => 'required',
            'objetivo' => 'required|min:2'
        ]);

        DB::update("UPDATE vehiculos SET kilometraje= ? WHERE id = ?", [$request->km_salida, $request->id_placa]);

        $validacionKm = DB::select(
            "SELECT * FROM vehiculos WHERE id = ?",
            [$request->id_placa]
        );

        foreach ($validacionKm as $val) {
            if ($request->km_salida < $val->kilometraje) {
                return redirect()->route('transporte.index')->with('errorHora', 'El kilometraje ingresado es menor al ultimo registrado.')->withInput();
            }
        }

        if ($request->km_destino < $request->km_salida) {
            return redirect()->route('transporte.index')->with('errorHora', 'El kilometraje de destino no puede ser menor al kilometraje de salida.')->withInput();
        }

        $comprobar = $this->comprobarHoras($request->hora_salida, $request->hora_destino);

        if ($comprobar == "errorHora") {
            return redirect()->route('transporte.index')->with('errorHora', 'La hora de destino no puede ser menor que la hora de salida.')->withInput();
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
        $transporte->objetivo = $request->objetivo;

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