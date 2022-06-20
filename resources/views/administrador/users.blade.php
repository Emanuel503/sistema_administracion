@extends('layouts.app')
@extends('administrador.menu')

@section('content')
<div class="container">
    <h1 class="mb-4">Usuarios</h1>

    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar usuario</button>

    @if (sizeof($usuarios) > 0)
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr class="table-dark">
                    <th>#</th>
                    <th>Nombre</th>
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
                    <td>{{$usuario->name}}</td>
                    <td>{{$usuario->id_rol}}</td>
                    <td>{{$usuario->id_dependencia}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>
                        <form action="" method="POST">
                            @method('DELETE')
                            @csrf
                            <a class="btn btn-success" href="">Modificar</a>
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
</div>

<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="modalTitulo">Registra nuevo usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="titulo" class="col-form-label">Titulo:</label>
                    <input type="text" class="form-control" name="titulo" id="titulo">
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="col-form-label">Descripcion:</label>
                    <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
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