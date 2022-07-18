<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MEMORANDUM</title>
    <style>
        .{
            margin-top: 7px;
            margin-left: 25px;
            margin-right: 25px;
        }
        img{
            width: 120px;
        }
        hr{
            width: 93%;
            margin-bottom: 0;
        }
        .memorandum{
            text-align: center;
            text-decoration: underline;
            margin-top: 3;
        }
        .fecha{
            float: right;
            position: absolute;
            top: 105px;
            margin-right: 17px;
        }
        .jefe{
            font-size: 11px;
            padding-left: 60px;
            position: absolute;
            top: 135px;
        }
        .leyenda-de{
            font-size: 12px;
            padding-left: 80px;
            position: absolute;
            top: 195px;
        }
        .texto{
            line-height: 30px;
            margin-left: 25px;
            margin-right: 25px;
            margin-top: 0;
        }
        .caja{
            border: 3px solid black;
            width: 95%;
            padding: 0;
            margin-top: 5px;
            margin-left: 20px;
            
        }
        .parrafo{
            line-height: 30px;
            margin-left: 12px;
            margin-right: 25px;
            margin-top: 0;
        }
        .titulo{
            margin-bottom: 0;
        }
        .atte{
            width: 100%;
            height: 40px;
        }
        .es-conforme{
            position: absolute;
            float: right;
            margin-right: 20px;
        }
        .coforme-nombre{
            position: absolute;
            margin-left: 440px;
            padding-top: 5px;
        }
        .caja h5{
            padding: 0;
            margin-top: 3;
            margin-bottom: 0;
        }
        .leyenda{
            font-size: 8px;
            position: absolute;
            float: right;
            margin-top: 0;
            margin-right: 10px;
        }
    </style>
</head>

@php
    $fechaActual = date('Y-m-d');
    $fechaRegistro = $transportes->fecha;
    if(strtotime($fechaActual) > strtotime($fechaRegistro)){
        $fechaActual = $fechaRegistro;
    }
@endphp
<body>
    <center><img src="{{env('APP_URL')}}/sistema_disam/public/img/logo.jpg"></center>
    <h4 class="memorandum">MEMORANDUM {{$transportes->correlativo}}</h4>
    
    <p class>Para: Ing. Oscar Vargas</p>
    <P class="fecha">Fecha: {{$fechaActual}}</P>
    <p class="jefe">JEFE SECCIÓN DISTRIBUCIÓN DE VEHÍCULOS</p>
    <br>
    <p>De:_________________________ </p>
    <p class="leyenda-de">Administradora DISAM</p>
    <hr>
    <p class="texto">
        Por este medio, autorizo la salida del vehículo Placas: {{$transportes->vehiculo->placa}}, combustible tipo: {{$transportes->vehiculo->tipo_combustible}},
        el cuál sera conducido por el Sr. {{$transportes->conductor->nombres}} {{$transportes->conductor->apellidos}}, con destino a: {{$transportes->lugar_s->nombre}} el día: {{$transportes->fecha}}, Hora salida: 
        {{$transportes->hora_salida}}, objetivo de la Misión: {{$transportes->objetivo}}
    </p>
    <div class="atte">
        <label>Atte:</label>
        <label class="es-conforme">Es conforme:________________________</label>
        <p class="coforme-nombre">Ing. Oscar Vargas</p>
    </div>
    <div class="caja">
        <center><h5 class="titulo">USO EXCLUSIVO DEL (A) ENCARGADO (A) DE COMBUSTIBLE</h5></center>
        <p class="parrafo">Unidad Solicitante _________________________________ Orden de Suministro N°_________<br>
        N° de Cupones________Serie___________al_________________<br>
        Tipo: Vehículo:____Moto:____Camión____Otros:____   Cantidad Asginada:_________Galones<br>
        Autorizado:________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kilometraje:____________________________<br>
        Recibido:_______________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sello:
        </p>
    </div>
    <p class="leyenda">Impreso en Oficina de Imprenta, Minsal</p>
</body>
</html>