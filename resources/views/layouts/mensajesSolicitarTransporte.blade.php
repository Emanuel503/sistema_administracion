@if (session('success'))
    <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('errorVehiculo'))
    <div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
        {{session('errorVehiculo')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('errorMotorista'))
    <div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
        {{session('errorMotorista')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('errorHora'))
    <div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
        {{session('errorHora')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@error('id_dependencia')
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror

@error('id_lugar')
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror

@error('fecha')
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror

@error('hora_salida')
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror

@error('hora_regreso')
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror

@error('objetivo')
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror

@error('observaciones')
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror