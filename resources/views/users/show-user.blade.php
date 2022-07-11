@extends('layouts.app')

@section('content')
    <h3 class="my-4">Detalles del usuario</h3>

    <a class="btn btn-outline-secondary mb-4" href="{{ route('users.index')}}">Regresar</a>

    <div class="mb-3">
        <label for="id_rol" class="col-form-label">Rol de usuario:</label>
        <input class="form-control" name="id_rol" id="id_rol" value="{{$usuario->rol->rol}}" readonly>
    </div>

    <div class="mb-3">
        <label for="id_dependencia" class="col-form-label">Dependencia:</label>
        <input class="form-control" name="id_rol" id="id_rol" value="{{$usuario->dependencia->nombre}}" readonly>
    </div>

    <div class="mb-3">
        <label for="usuario" class="col-form-label">Nombre de usuario:</label>
        <input type="text" class="form-control" name="usuario" id="usuario" value="{{$usuario->usuario}}" readonly>
    </div>

    <div class="mb-3">
        <label for="email" class="col-form-label">Correo electronico:</label>
        <input type="email" class="form-control" name="email" id="email" value="{{$usuario->email}}" readonly>
    </div>

    <div class="mb-3">
        <label for="nombres" class="col-form-label">Nombres:</label>
        <input type="text" class="form-control" name="nombres" id="nombres" value="{{$usuario->nombres}}" readonly>
    </div>

    <div class="mb-3">
        <label for="apellidos" class="col-form-label">Apellidos:</label>
        <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{$usuario->apellidos}}" readonly>
    </div>

    <div class="mb-3">
        <label for="cargo" class="col-form-label">Cargo:</label>
        <input type="text" class="form-control" name="cargo" id="cargo" value="{{$usuario->cargo}}" readonly>
    </div>

    <div class="mb-3">
        <label for="ubicacion" class="col-form-label">Ubicacion:</label>
        <input type="text" class="form-control" name="ubicacion" id="ubicacion" value="{{$usuario->ubicacion}}" readonly>
    </div>

    <div class="mb-3">
        <label for="telefono" class="col-form-label">Telefono:</label>
        <input type="text" class="form-control" name="telefono" id="telefono" value="{{$usuario->telefono}}" readonly>
    </div>

    <label class="col-form-label">Habilitar para motorista:</label>
    <div class="mb-3">
        <input disabled class="form-check-input" type="radio" name="motorista" id="si" value="si" @checked($usuario->motorista == "si")>
        <label class="form-check-label" for="si">Si</label>

        <input disabled class="form-check-input" type="radio" name="motorista" id="no" value="no" @checked($usuario->motorista == "no")>
        <label class="form-check-label" for="no">No</label>
    </div>

    <div class="mb-3">
        <label for="id_estado" class="col-form-label">Estado:</label>
        <input type="text" class="form-control" name="id_estado" id="id_estado" value="{{$usuario->estadoUsuario->estado}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_registro" class="col-form-label">Fecha de registro:</label>
        <input type="text" class="form-control" name="fecha_registro" id="fecha_registro" value="{{$usuario->created_at}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_modificacion" class="col-form-label">Ultima fecha de modificacion:</label>
        <input type="text" class="form-control" name="fecha_modificacion" id="fecha_modificacion" value="{{$usuario->updated_at}}" readonly>
    </div>

    <form action="{{ route('users.destroy' , ['user' => $usuario->id]) }}" method="POST">
        @method('DELETE')
        @csrf
        <a class="btn btn-success" href="{{ route('users.edit' , ['user' => $usuario->id])}}">Modificar</a>
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