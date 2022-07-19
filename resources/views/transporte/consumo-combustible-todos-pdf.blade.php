<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de consumo combustible</title>
    <style>
        .{
            margin-top: 7px;
            margin-left: 7px;
            margin-right: 14px;
            font-size: 13px;
        }

        th, td{
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .text-center{
            text-align: center;
        }

        .titulo{
            text-align: left;
        }
        .espacio{
            height: 20px;
            border: none;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th colspan="11">
                    <p class="titulo">MINISTERIO DE SALUD<br>DIRECCIÓN DE SALUD AMBIENTAL</p>
                    <p>CONSUMO-COMBUSTIBLE<br>MES: @php echo strtoupper($mes) @endphp {{$year}}</p>
                </th>
            </tr>
            <tr>
                <th>PLACA</th>
                <th>Nombre del motorista</th>
                <th>No. de<br>Memo</th>
                <th>Fecha Memo</th>
                <th>Lugar Visitado</th>
                <th>Fecha Salida</th>
                <th>Combustible<br>registrado<br>(Galones)</th>
                <th>Kilometraje<br>Inicial</th>
                <th>Kilometraje<br>Final</th>
                <th>Kilometraje<br> Recorrido (F-I)</th>
                <th>Rend. Promedio<br>(Km recorr/<br>comb. Regis)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehiculos as $vehiculo)
                @foreach ($transportes as $transporte)
                    @if ($vehiculo->placa == $transporte->placa)
                        @php
                            $total_combustible = 0;
                            $total_km_salida = 0;
                            $total_km_destino = 0;
                            $total_km_recorrido = 0;
                            $promedio_combustible = 0;

                            foreach ($transportes as $transporte) {
                                if ($vehiculo->placa == $transporte->placa){
                                    $placa = $transporte->placa;
                                    $total_combustible =  $total_combustible + $transporte->combustible;
                                    $total_km_salida =  $total_km_salida + $transporte->km_salida;
                                    $total_km_destino =  $total_km_destino + $transporte->km_destino;
                                    $total_km_recorrido = $total_km_recorrido + $transporte->distancia_recorrida;
                                    $promedio_combustible = number_format($total_km_recorrido / $total_combustible,2);
                                }
                            }
                        @endphp
            
                        <tr>
                            <td>{{$transporte->placa}}</td>
                            <td>{{$transporte->conductor}}</td>
                            <td class="text-center">
                                @php
                                    $numero = explode("-", $transporte->correlativo);
                                    echo $numero[1];
                                @endphp
                            </td>
                            <td class="text-center">{{$transporte->fecha}}</td>
                            <td class="text-center">{{$transporte->lugar_d}}</td>
                            <td class="text-center">{{$transporte->fecha}}</td>
                            <td class="text-center">{{$transporte->combustible}}</td>
                            <td class="text-center">{{$transporte->km_salida}}</td>
                            <td class="text-center">{{$transporte->km_destino}}</td>
                            <td class="text-center">{{$transporte->distancia_recorrida}}</td>
                            <td class="text-center">{{number_format($transporte->distancia_recorrida/$transporte->combustible,2)}}</td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="6"></td>
                    <td class="text-center"><b>{{$total_combustible}}</b></td>
                    <td class="text-center"><b>{{$total_km_salida}}</b></td>
                    <td class="text-center"><b>{{$total_km_destino}}</b></td>
                    <td class="text-center"><b>{{$total_km_recorrido}}</b></td>
                    <td class="text-center"><b>{{$promedio_combustible}}</b></td>
                </tr>
                <tr>
                    <td class="espacio" colspan="11"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>