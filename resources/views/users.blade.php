@php
if (Auth::user()->rol->rol != "Administrador"){
header("Location: home");
die();
}
@endphp

@extends('layouts.app')

@section('content')
<h3 class="mb-4">Usuarios</h3>

<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar usuario</button>

@include('layouts.mensajesUsers')

@if (sizeof($usuarios) > 0)
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr class="table-dark">
            <th>#</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Rol</th>
            <th>Dependencia</th>
            <th>Email</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario )
        <tr>
            <td>{{$usuario->id}}</td>
            <td>{{$usuario->nombres}}</td>
            <td>{{$usuario->apellidos}}</td>
            <td>{{$usuario->rol->rol}}</td>
            <td>{{$usuario->dependencia->nombre}}</td>
            <td>{{$usuario->email}}</td>
            <td>
                <form action="{{ route('users.destroy' , ['user' => $usuario->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <a class="btn btn-success" href="{{ route('users.show' , ['user' => $usuario->id])}}">Modificar</a>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<br><span class="badge bg-secondary">No hay usuarios registrados</span>
@endif

<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">Registra nuevo usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_rol" class="col-form-label">Rol de usuario:</label>
                        <select id="id_rol" class="form-select" name="id_rol">
                            @foreach ($roles as $rol )
                            <option value="{{$rol->id}}">{{$rol->rol}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_dependencia" class="col-form-label">Dependencia:</label>
                        <select id="id_dependencia" class="form-select" name="id_dependencia">
                            @foreach ($dependencias as $dependencia )
                            <option value="{{$dependencia->id}}">{{$dependencia->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="usuario" class="col-form-label">Nombre de usuario:</label>
                        <input type="text" class="form-control" name="usuario" id="usuario">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="col-form-label">Correo electronico:</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="col-form-label">Contraseña:</label>
                        <input type="text" class="form-control" name="password" id="password">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="col-form-label">Confirmar contraseña:</label>
                        <input type="text" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>

                    <div class="mb-3">
                        <label for="nombres" class="col-form-label">Nombres:</label>
                        <input type="text" class="form-control" name="nombres" id="nombres">
                    </div>

                    <div class="mb-3">
                        <label for="apellidos" class="col-form-label">Apellidos:</label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos">
                    </div>

                    <div class="mb-3">
                        <label for="cargo" class="col-form-label">Cargo:</label>
                        <input type="text" class="form-control" name="cargo" id="cargo">
                    </div>

                    <div class="mb-3">
                        <label for="ubicacion" class="col-form-label">Ubicacion:</label>
                        <input type="text" class="form-control" name="ubicacion" id="ubicacion">
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="col-form-label">Telefono:</label>
                        <input type="text" class="form-control" name="telefono" id="telefono">
                    </div>

                    <label class="col-form-label">Habilitar para motorista:</label>
                    <div class="mb-3">
                        <input class="form-check-input" type="radio" name="motorista" id="si" value="si">
                        <label class="form-check-label" for="si">Si</label>

                        <input class="form-check-input" type="radio" name="motorista" id="no" value="no" checked>
                        <label class="form-check-label" for="no">No</label>
                    </div>

                    <div class="mb-3">
                        <label for="id_estado" class="col-form-label">Estado:</label>
                        <select id="id_estado" class="form-select" name="id_estado">
                            @foreach ($estadosUsuarios as $estado )
                            <option value="{{$estado->id}}">{{$estado->estado}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection