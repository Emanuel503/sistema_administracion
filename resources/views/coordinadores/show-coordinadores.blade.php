@extends('layouts.app')

@section('content')
<h3 class="my-4">Detalles del coordinador</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('coordinadores.index')}}">Regresar</a>

<div class="mb-3">
    <label for="usuario" class="col-form-label">Técnico usuario:</label>
    <input class="form-control" name="usuario" id="usuario" value="{{$coordinadores->usuario->nombres}} {{$coordinadores->usuario->apellidos}}" readonly>
</div>

<div class="mb-3">
    <label for="tipo_coordinacion" class="col-form-label">Tipo de coordinación:</label>
    <input type="text" class="form-control" name="tipo_coordinacion" id="tipo_coordinacion" value="{{$coordinadores->coordinacion->tipo_coordinacion}}" readonly>
</div>

<form action="{{ route('coordinadores.destroy' , ['coordinadore' => $coordinadores->id]) }}" method="POST">
    @method('DELETE')
    @csrf
    <a class="btn btn-success" href="{{ route('coordinadores.edit' , ['coordinadore' => $coordinadores->id])}}">Modificar</a>
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