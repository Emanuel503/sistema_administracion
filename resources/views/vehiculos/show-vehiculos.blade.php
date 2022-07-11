@extends('layouts.app')

@section('content')
    <h3 class="my-4">Detalles del vehiculo</h3>

    <a class="btn btn-outline-secondary mb-4" href="{{ route('vehiculos.index')}}">Regresar</a>

    <div class="mb-3">
        <label for="placa" class="col-form-label">Número de placa:</label>
        <input class="form-control" name="placa" id="placa" value="{{$vehiculos->placa}}" readonly>
    </div>

    <div class="mb-3">
        <label for="marca" class="col-form-label">Marca:</label>
        <input class="form-control" name="marca" id="marca" value="{{$vehiculos->marca}}" readonly>
    </div>

    <div class="mb-3">
        <label for="modelo" class="col-form-label">Modelo:</label>
        <input class="form-control" name="modelo" id="modelo" value="{{$vehiculos->modelo}}" readonly>
    </div>

    <div class="mb-3">
        <label for="color" class="col-form-label">Color:</label>
        <input class="form-control" name="color" id="color" value="{{$vehiculos->color}}" readonly>
    </div>

    <div class="mb-3">
        <label for="year" class="col-form-label">Año:</label>
        <input class="form-control" name="year" id="year" value="{{$vehiculos->year}}" readonly>
    </div>

    <div class="mb-3">
        <label for="km" class="col-form-label">Kilometraje del vehiculo:</label>
        <input class="form-control" name="km" id="km" value="{{$vehiculos->kilometraje}}" readonly>
    </div>

    <div class="mb-3">
        <label for="tipo_combustible" class="col-form-label">Tipo de combustible:</label>
        <input type="text" class="form-control" name="tipo_combustible" id="tipo_combustible" value="{{$vehiculos->tipo_combustible}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_registro" class="col-form-label">Fecha de registro:</label>
        <input type="text" class="form-control" name="fecha_registro" id="fecha_registro" value="{{$vehiculos->created_at}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_modificacion" class="col-form-label">Ultima fecha de modificacion:</label>
        <input type="text" class="form-control" name="fecha_modificacion" id="fecha_modificacion" value="{{$vehiculos->updated_at}}" readonly>
    </div>

    <form action="{{ route('vehiculos.destroy' , ['vehiculo' => $vehiculos->id]) }}" method="POST">
        @method('DELETE')
        @csrf
        <a class="btn btn-success" href="{{ route('vehiculos.edit' , ['vehiculo' => $vehiculos->id])}}">Modificar</a>
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