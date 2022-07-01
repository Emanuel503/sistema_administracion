@extends('layouts.app')

@section('content')
    <h3 class="my-4">Detalles del registro de salida</h3>

    <a class="btn btn-outline-secondary mb-4" href="{{ route('registros-salida.index')}}">Regresar</a>

    <div class="mb-3">
        <label for="id_lugar" class="col-form-label">Lugar:</label>
        <input class="form-control" name="id_lugar" id="id_lugar" value="{{ $salidas->lugar->nombre }}" readonly>
    </div>
    <div class="mb-3">
        <label for="departamento" class="col-form-label">Departamento:</label>
        <input type="text" class="form-control" name="departamento" id="departamento" value="{{ $salidas->lugar->departamento}}" readonly>
    </div>

    <div class="mb-3">
        <label for="municipio" class="col-form-label">Municipio:</label>
        <input type="text" class="form-control" name="municipio" id="municipio" value="{{ $salidas->lugar->municipio}}" readonly>
    </div>

    <div class="mb-3">
        <label for="usuario" class="col-form-label">Usuario:</label>
        <input type="text" class="form-control" name="usuario" id="usuario" value="{{ $salidas->usuario->nombres}} {{ $salidas->usuario->apellidos}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha" class="col-form-label">Fecha de salida:</label>
        <input type="date" class="form-control" name="fecha" id="fecha" value="{{ $salidas->fecha }}" readonly>
    </div>

    <div class="mb-3">
        <label for="hora_inicio" class="col-form-label">Hora de inicio:</label>
        <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" value="{{ $salidas->hora_inicio }}" readonly>
    </div>

    <div class="mb-3">
        <label for="hora_final" class="col-form-label">Hora de finalizacion:</label>
        <input type="time" class="form-control" name="hora_final" id="hora_final" value="{{ $salidas->hora_final }}" readonly>
    </div>

    <div class="mb-3">
        <label for="objetivo" class="col-form-label">Objetivo:</label>
        <textarea readonly class="form-control" name="objetivo" id="objetivo">{{ $salidas->objetivo}}</textarea>
    </div>

    <div class="mb-3">
        <label for="fecha_registro" class="col-form-label">Fecha de registro:</label>
        <input type="text" class="form-control" name="fecha_registro" id="fecha_registro" value="{{$salidas->created_at}}" readonly>
    </div>
    
    <div class="mb-3">
        <label for="fecha_registro" class="col-form-label">Ultima fecha de modificacion:</label>
        <input type="text" class="form-control" name="fecha_registro" id="fecha_registro" value="{{$salidas->updated_at}}" readonly>
    </div>

    @if(Auth::user()->rol->id == $salidas->usuario->id)
        <form action="{{ route('registros-salida.destroy' , ['registros_salida' => $salidas->id]) }}" method="POST">
            @method('DELETE')
            @csrf
            <a class="btn btn-success" href="{{ route('registros-salida.edit' , ['registros_salida' => $salidas->id])}}">Modificar</a>
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    @endif
@endsection