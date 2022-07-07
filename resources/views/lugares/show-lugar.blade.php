@extends('layouts.app')

@section('content')
<h3 class="my-4">Detalles de la lugares</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('lugares.index')}}">Regresar</a>

<div class="mb-3">
    <label for="nombre" class="col-form-label">Nombre del lugar:</label>
    <input class="form-control" name="nombre" id="nombre" value="{{$lugares->nombre}}" readonly>
</div>

<div class="mb-3">
    <label for="codigo" class="col-form-label">Codigo:</label>
    <input class="form-control" name="codigo" id="codigo" value="{{$lugares->codigo}}" readonly>
</div>

<div class="mb-3">
    <label for="departamento" class="col-form-label">Departamento:</label>
    <input class="form-control" name="departamento" id="departamento" value="{{$lugares->departamentos->departamento}}" readonly>
</div>

<div class="mb-3">
    <label for="municipio" class="col-form-label">Municipio:</label>
    <input class="form-control" name="municipio" id="municipio" value="{{$lugares->municipios->municipio}}" readonly>
</div>

<div class="mb-3">
    <label for="fecha_registro" class="col-form-label">Fecha de registro:</label>
    <input type="text" class="form-control" name="fecha_registro" id="fecha_registro" value="{{$lugares->created_at}}" readonly>
</div>

<div class="mb-3">
    <label for="fecha_modificacion" class="col-form-label">Ultima fecha de modificacion:</label>
    <input type="text" class="form-control" name="fecha_modificacion" id="fecha_modificacion" value="{{$lugares->updated_at}}" readonly>
</div>

<form action="{{ route('lugares.destroy' , ['lugare' => $lugares->id]) }}" method="POST">
    @method('DELETE')
    @csrf
    <a class="btn btn-success" href="{{ route('lugares.edit' , ['lugare' => $lugares->id])}}">Modificar</a>
    <input name="_method" type="hidden" value="DELETE"><input name="_method" type="hidden" value="DELETE">
    <button type="submit" class="btn btn btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>
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