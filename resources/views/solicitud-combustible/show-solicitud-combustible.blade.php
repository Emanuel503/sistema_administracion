@extends('layouts.app')

@section('content')

    <h3 class="my-4">Detalles de solicitud combustible</h3>

    <a class="btn btn-outline-secondary mb-4" href="{{ route('solicitud-combustible.index')}}">Regresar</a>

    <div class="mb-3">
        <label for="id_destinatario" class="col-form-label">Para:</label>
        <input type="text" class="form-control" name="id_destinatario" id="id_destinatario" value="{{$solicitudes->destinatario->nombres}} {{$solicitudes->destinatario->apellidos}}" readonly>
    </div>

    <div class="mb-3">
        <label for="id_origen" class="col-form-label">De:</label>
        <input type="text" class="form-control" name="id_origen" id="id_origen" value="{{$solicitudes->origen->nombres}} {{$solicitudes->origen->apellidos}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_solicitud" class="col-form-label">Fecha solicitud:</label>
        <input type="date" class="form-control" name="fecha_solicitud" id="fecha_solicitud" value="{{$solicitudes->fecha_solicitud}}" readonly>
    </div>

    <h5>Detalles de la solicitud</h5>

    <div class="mb-3">
        <label for="id_placa" class="col-form-label">Placa:</label>
        <input type="text" class="form-control" name="id_placa" id="id_placa" value="{{$solicitudes->vehiculo->placa}}" readonly>
    </div>

    <div class="mb-3">
        <label for="id_conductor" class="col-form-label">Conductor:</label>
        <input type="text" class="form-control" name="id_conductor" id="id_conductor" value="{{$solicitudes->conductor->nombres}} {{$solicitudes->conductor->apellidos}}" readonly>
    </div>

    <div class="mb-3">
        <label for="lugar_destino" class="col-form-label">Lugar destino:</label>
        <input type="text" class="form-control" name="lugar_destino" id="lugar_destino" value="{{$solicitudes->lugar_d->nombre}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_detalle" class="col-form-label">Día:</label>
        <input type="text" class="form-control" name="lugar_destino" id="lugar_destino" value="{{$solicitudes->fecha_detalle}}" readonly>
    </div>

    <div class="mb-3">
        <label for="hora_salida" class="col-form-label">Hora de salida:</label>
        <input type="text" class="form-control" name="lugar_destino" id="lugar_destino" value="{{$solicitudes->hora_salida}}" readonly>
    </div>

    <div class="mb-3">
        <label for="objetivo" class="col-form-label">Objetivo de la misión:</label>
        <input type="text" class="form-control" name="lugar_destino" id="lugar_destino" value="{{$solicitudes->objetivo}}" readonly>
    </div>

    <div class="mb-3">
        <label for="tipo_combustible" class="col-form-label">Solicita tipo de combustible:</label>
        <input type="text" class="form-control" name="lugar_destino" id="lugar_destino" value="{{$solicitudes->tipo_combustible}}" readonly>
    </div>

    <div class="mb-3">
        <label for="cantidad_combustible" class="col-form-label">Cantidad de galones autorizado:</label>
        <input type="text" class="form-control" name="lugar_destino" id="lugar_destino" value="{{$solicitudes->cantidad_combustible}} gal." readonly>
    </div>

    <div class="mb-3">
        <label for="km" class="col-form-label">Kilometraje vehiculo:</label>
        <input type="text" class="form-control" name="km" id="km" value="{{$solicitudes->kilometraje}} km" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_registro" class="col-form-label">Fecha de solicitud:</label>
        <input type="text" class="form-control" name="fecha_registro" id="fecha_registro" value="{{$solicitudes->created_at}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_modificacion" class="col-form-label">Ultima fecha de modificacion:</label>
        <input type="text" class="form-control" name="fecha_modificacion" id="fecha_modificacion" value="{{$solicitudes->updated_at}}" readonly>
    </div>

    <form action="{{ route('solicitud-combustible.destroy' , ['solicitud_combustible' => $solicitudes->id]) }}" method="POST">
        @method('DELETE')
        @csrf
        <a class="btn btn-success" href="{{ route('solicitud-combustible.edit' , ['solicitud_combustible' => $solicitudes->id])}}">Modificar</a>
        <input name="_method" type="hidden" value="DELETE"><input name="_method" type="hidden" value="DELETE">
        <button type="submit" class="btn btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>
    </form>
@endsection

@section('js-alert-delete')
    <script src="{{ asset('js/alert-delete.js') }}"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `¿Seguro que desea borrar este registro?`,
                    text: "Si elimina este registro no se podra recuperar.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection