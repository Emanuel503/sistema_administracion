@php
    if (Auth::user()->rol->rol != "Administrador"){
        header("Location: home");
        die();
    }
@endphp

@section('css-data-table')
    <link href="{{ asset('css/DataTables.css') }}" rel="stylesheet">
@endsection

@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Usuarios</h3>

    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar usuario</button>

    @include('layouts.alerts')
    @include('users.alerts')

    @if (sizeof($usuarios) > 0)
        <div class="table-responsive">
            <table id="usuarios" class="table table-striped table-hover table-bordered table-sm shadow">
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
                        <td>{{$loop->iteration}}</td>
                        <td>{{$usuario->nombres}}</td>
                        <td>{{$usuario->apellidos}}</td>
                        <td>{{$usuario->rol->rol}}</td>
                        <td>{{$usuario->dependencia->nombre}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>
                            <form action="{{ route('users.destroy' , ['user' => $usuario->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div class="d-grid gap-1 d-md-flex">
                                    <a class="btn btn-info btn-sm" href="{{ route('users.show' , ['user' => $usuario->id])}}">Ver</a>
                                    <a class="btn btn-success btn-sm" href="{{ route('users.edit' , ['user' => $usuario->id])}}">Modificar</a>
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <br><span class="badge bg-secondary">No hay usuarios registrados</span>
    @endif

    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
        <div class="modal-dialog">
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
                                    <option @selected(old('id_rol')==$rol->id) value="{{$rol->id}}">{{$rol->rol}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_dependencia" class="col-form-label">Dependencia:</label>
                            <select id="id_dependencia" class="form-select" name="id_dependencia">
                                @foreach ($dependencias as $dependencia )
                                    <option @selected(old('id_dependencia')==$dependencia->id) value="{{$dependencia->id}}">{{$dependencia->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="usuario" class="col-form-label">Nombre de usuario:</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" value="{{ old('usuario') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="col-form-label">Correo electronico:</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="col-form-label">Contraseña:</label>
                            <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="col-form-label">Confirmar contraseña:</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombres" class="col-form-label">Nombres:</label>
                            <input type="text" class="form-control" name="nombres" id="nombres" value="{{ old('nombres') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="apellidos" class="col-form-label">Apellidos:</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{ old('apellidos') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="cargo" class="col-form-label">Cargo:</label>
                            <input type="text" class="form-control" name="cargo" id="cargo" value="{{ old('cargo') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="ubicacion" class="col-form-label">Ubicacion:</label>
                            <input type="text" class="form-control" name="ubicacion" id="ubicacion" value="{{ old('ubicacion') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="col-form-label">Telefono:</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}" required>
                        </div>

                        <label class="col-form-label">Habilitar para motorista:</label>
                        <div class="mb-3">
                            <input class="form-check-input" type="radio" name="motorista" id="si" value="si" @checked(old('motorista')=='si' )>
                            <label class="form-check-label" for="si">Si</label>

                            <input class="form-check-input" type="radio" name="motorista" id="no" value="no" @checked(old('motorista')==null) @checked(old('motorista')=='no' )>
                            <label class="form-check-label" for="no">No</label>
                        </div>

                        <div class="mb-3">
                            <label for="id_estado" class="col-form-label">Estado:</label>
                            <select id="id_estado" class="form-select" name="id_estado">
                                @foreach ($estadosUsuarios as $estado )
                                    <option @selected(old('id_estado')==$estado->id) value="{{$estado->id}}">{{$estado->estado}}</option>
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

@section('js-data-table')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#usuarios tbody').on('click', 'tr', function() {
                $(this).toggleClass('selected');
            });

            $('#usuarios').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
    </script>
@endsection