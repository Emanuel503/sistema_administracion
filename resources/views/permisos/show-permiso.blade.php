@extends('layouts.app')

@section('content')
<h3 class="my-4">Detalles del permiso</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('permisos.index')}}">Regresar</a>

<div class="mb-3">
    <label for="usuario" class="col-form-label">Usuario:</label>
    <input type="text" class="form-control" name="usuario" id="usuario" value="{{$permisos->usuario->nombres}} {{$permisos->usuario->apellidos}}" readonly>
</div>

<div class="mb-3">
    <label for="dependencia" class="col-form-label">Dependencia:</label>
    <input type="text" class="form-control" name="dependencia" id="dependencia" value="{{$permisos->depen->nombre}}" readonly>
</div>

<div class="mb-3">
    <label for="licencia" class="col-form-label">Licencia:</label>
    <input type="text" class="form-control" name="licencia" id="licencia" value="{{$permisos->licencia->tipo_permiso}}" readonly>
</div>

<div class="mb-3">
    <label for="motivo" class="col-form-label">Motivo:</label>
    <input type="text" class="form-control" name="motivo" id="motivo" value="{{$permisos->motiv->motivo}}" readonly>
</div>

<div class="mb-3">
    <label for="usuario_autoriza" class="col-form-label">Usuario autoriza:</label>
    <input type="text" class="form-control" name="usuario_autoriza" id="usuario_autoriza" value="{{$permisos->usuarioAuto->nombres}} {{$permisos->usuarioAuto->apellidos}}" readonly>
</div>

<div class="mb-3">
    <label for="usuario_adiciono" class="col-form-label">Usuario adiciono:</label>
    <input type="text" class="form-control" name="usuario_adiciono" id="usuario_adiciono" value="{{$permisos->usuarioAdi->nombres}} {{$permisos->usuarioAdi->apellidos}}" readonly>
</div>

<div class="mb-3">
    <label for="estado" class="col-form-label">Estado:</label>
    <input type="text" class="form-control" name="estado" id="estado" value="{{$permisos->estado->estado}}" readonly>
</div>

<div class="mb-3">
    <label for="fecha_entrada" class="col-form-label">Fecha entrada:</label>
    <input type="date" class="form-control" name="fecha_entrada" id="fecha_entrada" value="{{$permisos->fecha_entrada}}" readonly>
</div>

<div class="mb-3">
    <label for="hora_entrada" class="col-form-label">Hora entrada:</label>
    <input type="time" class="form-control" name="hora_entrada" id="hora_entrada" value="{{$permisos->hora_entrada}}" readonly>
</div>

<div class="mb-3">
    <label for="fecha_salida" class="col-form-label">Fecha salida:</label>
    <input type="date" class="form-control" name="fecha_salida" id="fecha_salida" value="{{$permisos->fecha_salida}}" readonly>
</div>

<div class="mb-3">
    <label for="hora_salida" class="col-form-label">Hora salida:</label>
    <input type="time" class="form-control" name="hora_salida" id="hora_salida" value="{{$permisos->hora_salida}}" readonly>
</div>

<div class="mb-3">
    <label for="dia" class="col-form-label">Día:</label>
    <input type="text" class="form-control" name="dia" id="dia" value="{{$permisos->tiempo_dia}}" readonly>
</div>

<div class="mb-3">
    <label for="horas" class="col-form-label">Horas:</label>
    <input type="text" class="form-control" name="horas" id="horas" value="{{$permisos->tiempo_horas}}" readonly>
</div>

<div class="mb-3">
    <label for="minutos" class="col-form-label">Minutos:</label>
    <input type="text" class="form-control" name="minutos" id="minutos" value="{{$permisos->tiempo_minutos}}" readonly>
</div>

<div class="mb-3">
    <label for="fecha_permiso" class="col-form-label">Fecha permiso:</label>
    <input type="date" class="form-control" name="fecha_permiso" id="fecha_permiso" value="{{$permisos->fecha_permiso}}" readonly>
</div>

@if ($permisos->id_usuario_adiciono == Auth::user()->id)
<form action="{{ route('permisos.destroy' , ['permiso' => $permisos->id]) }}" method="POST">
    @method('DELETE')
    @csrf
    <a class="btn btn-success" href="{{ route('permisos.edit' , ['permiso' => $permisos->id])}}">Modificar</a>
    <input name="_method" type="hidden" value="DELETE"><input name="_method" type="hidden" value="DELETE">
    <button type="submit" class="btn btn btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>
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