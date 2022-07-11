@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Detalles de la solicitud de sala</h3>

    <a href="{{route('solicitudes-sala.index')}}" class="btn btn-outline-secondary mb-4">Regresar</a>

    <div class="mb-3">
        <label for="id_usuario" class="col-form-label">Usuarios solicitante:</label>
        <input class="form-control" name="id_usuario" value="{{$solicitudesSala->usuario->nombres}} {{$solicitudesSala->usuario->apellidos}}" readonly>
    </div>

    <div class="mb-3">
        <label for="id_sala" class="col-form-label">Sala:</label>
        <input type="text" class="form-control" name="id_sala" id="id_sala" value="{{ $solicitudesSala->sala->sala}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha" class="col-form-label">Fecha de utilizacion:</label>
        <input type="date" class="form-control" name="fecha" id="fecha" value="{{ $solicitudesSala->fecha }}" readonly>
    </div>

    <div class="mb-3">
        <label for="hora_inicio" class="col-form-label">Hora de inicio:</label>
        <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" value="{{ $solicitudesSala->hora_inicio }}" readonly>
    </div>

    <div class="mb-3">
        <label for="hora_finalizacion" class="col-form-label">Hora de finalizacion:</label>
        <input type="time" class="form-control" name="hora_finalizacion" id="hora_finalizacion" value="{{ $solicitudesSala->hora_finalizacion }}" readonly>
    </div>

    <div class="mb-3">
        <label for="actividad" class="col-form-label">Descripcion de la actividad:</label>
        <textarea class="form-control" name="actividad" id="actividad" readonly>{{$solicitudesSala->actividad}}</textarea>
    </div>

    <div class="mb-3">
        <label for="observaciones" class="col-form-label">Observaciones:</label>
        <textarea class="form-control" name="observaciones" id="observaciones" readonly>{{$solicitudesSala->observaciones}}</textarea>
    </div>

    <div class="mb-3">
        <label for="id_autorizacion" class="col-form-label">Autorizacion:</label>
        <input type="text" class="form-control" name="id_autorizacion" id="id_autorizacion" value="{{ $solicitudesSala->autorizacion->autorizacion}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_registro" class="col-form-label">Fecha de solicitud:</label>
        <input type="text" class="form-control" name="fecha_registro" id="fecha_registro" value="{{$solicitudesSala->created_at}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_modificacion" class="col-form-label">Ultima fecha de modificacion:</label>
        <input type="text" class="form-control" name="fecha_modificacion" id="fecha_modificacion" value="{{$solicitudesSala->updated_at}}" readonly>
    </div>

    @if(Auth::user()->rol->id == "1" || ($solicitudesSala->id_autorizacion == 3 && Auth::user()->id == $solicitudesSala->usuario->id))
        <form action="{{ route('solicitudes-sala.destroy' , ['solicitudes_sala' => $solicitudesSala->id]) }}" method="POST">
            @method('DELETE')
            @csrf
            <a class="btn btn-success" href="{{ route('solicitudes-sala.edit' , ['solicitudes_sala' => $solicitudesSala->id])}}">Modificar</a>
            <input name="_method" type="hidden" value="DELETE"><input name="_method" type="hidden" value="DELETE">
        <button type="submit" class="btn btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>
        </form>
    @endif
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
