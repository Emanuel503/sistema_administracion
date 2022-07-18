<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de bitacora recorridos</title>
    <style>
        .{
            margin-top: 7px;
            margin-left: 7px;
            margin-right: 14px;
            font-size: 12px;
        }
        img{
            width: 120px;
        }
        table, th, td{
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        label{
            font-style: bold;
        }
        
        .leyenda-vobo{
            font-size: 8px;
            margin-left: 7px;
        }
        .leyenda{
            font-size: 8px;
            position: absolute;
            float: right;
            margin-top: 0;
            margin-right: 0px;
        }
        .text-center{
            text-align: center;
        }
        .leyenda-jefe{
            margin-left: 370px;
        }
    </style>
</head>
<body>
    @php
        $total_galones = 0;
        $total_kilometraje = 0;
        $dependencia = "";
        $placa = "";

        foreach ($transportes as $transporte) {
            $total_galones = $total_galones + $transporte->combustible;
            $total_kilometraje = $total_kilometraje + $transporte->distancia_recorrida;
            $dependencia = $transporte->dependencia;
            $placa = $transporte->placa;
        }
    @endphp

    <img src="{{env('APP_URL')}}/sistema_disam/public/img/logo.jpg"><br><br>
    <label>BITACORA RECORRIDOS Y CONSUMO DE COMBUSTIBLE</label><br>
    <label>DEPENDENCIA:</label>{{$dependencia}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label> PLACA DE VEHICULO:</label>{{$placa}}<br>
    <label>MES:</label>{{$mes}} <label>AÑO:</label>{{$year}}

    <table>
        <thead>
            <tr>
                <th colspan="4">Salida</th>
                <th colspan="5">Destino</th>
                <th rowspan="2">Nombre del conductor</th>
                <th rowspan="2">Nombre del responsable de la unidad</th>
                <th colspan="2">COMBUSTIBLE RECIBIDO EN GLS.</th>
                <th rowspan="2">Nivel en tanque</th>
            </tr>
            <tr>
                <th>DIA</th>
                <th>HORA</th>
                <th>Kilometraje Velocimetro</th>
                <th>Lugar</th>
                <th>HORA</th>
                <th>Kilometraje Velocimetro</th>
                <th>Lugar</th>
                <th>Distancia Recorrida<br> (km)</th>
                <th>Distancia Recorrida<br> interdep. (km)</th>
                <th>Minsal</th>
                <th>Otros</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transportes as $transporte)
            <tr>
                @php
                    $dia = strtotime($transporte->fecha);
                @endphp
                <td>{{date("d", $dia)}}</td>
                <td>{{$transporte->hora_salida}}</td>
                <td class="text-center">{{$transporte->km_salida}}</td>
                <td>{{$transporte->lugar_s}}</td>
                <td>{{$transporte->hora_destino}}</td>
                <td class="text-center">{{$transporte->km_destino}}</td>
                <td>{{$transporte->lugar_d}}</td>
                <td class="text-center">{{$transporte->distancia_recorrida}}</td>
                <td class="text-center">{{$transporte->distancia_recorrida}}</td>
                <td>{{$transporte->conductor}}</td>
                <td>{{$transporte->pasajero}}</td>
                <td class="text-center"> @if ($transporte->tipo_combustible == "Salud") {{$transporte->combustible}} @endif </td>
                <td class="text-center"> @if ($transporte->tipo_combustible == "Otros") {{$transporte->combustible}} @endif </td>
                <td class="text-center">{{$transporte->nivel_tanque}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="leyenda-vobo">VoBo</span>
    <p class="leyenda">Impreso en Oficina de Imprenta, Minsal</p><br><br>

    <label>Nombre:_____________________________</label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <label>Firma:______________________________</label>
    <label>Total de Galones recibidos: </label>{{$total_galones}}
    <label>Total de kilometraje: </label>{{$total_kilometraje}}km<br>
    <span class="leyenda-jefe">Jefe dependencia</span>
</body>
</html>