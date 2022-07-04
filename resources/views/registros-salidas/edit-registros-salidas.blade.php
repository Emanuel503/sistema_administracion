@extends('layouts.app')

@section('content')
    <h3 class="my-4">Modificar registro de salida</h3>

    <a class="btn btn-outline-secondary mb-4" href="{{ route('registros-salida.index')}}">Regresar</a>

    @include('layouts.alerts')
    @include('registros-salidas.alerts')

    <form action="{{ route('registros-salida.update' , ['registros_salida' => $salidas->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="id_lugar" class="col-form-label">Lugar:</label>
            <select id="id_lugar" class="form-select" name="id_lugar">
                @foreach ($lugares as $lugar )
                    <option @selected($salidas->id_lugar == $lugar->id) value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha" class="col-form-label">Fecha de salida:</label>
            <input type="date" class="form-control" name="fecha" id="fecha" value="{{ $salidas->fecha }}" required>
        </div>

        <div class="mb-3">
            <label for="hora_inicio" class="col-form-label">Hora de inicio:</label>
            <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" value="{{ $salidas->hora_inicio }}" required>
        </div>

        <div class="mb-3">
            <label for="hora_final" class="col-form-label">Hora de finalizacion:</label>
            <input type="time" class="form-control" name="hora_final" id="hora_final" value="{{ $salidas->hora_final }}" required>
        </div>

        <div class="mb-3">
            <label for="objetivo" class="col-form-label">Objetivo:</label>
            <textarea required class="form-control" name="objetivo" id="objetivo">{{ $salidas->objetivo}}</textarea>
        </div>

        <div class="mb-3">
            <label for="id_estado" class="col-form-label">Lugar:</label>
            <select id="id_estado" class="form-select" name="id_estado">
                @foreach ($estados as $estado )
                    <option @selected($salidas->id_estado == $estado->id) value="{{$estado->id}}">{{$estado->estado}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Modificar</button>
        <a href="{{route('registros-salida.index')}}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection