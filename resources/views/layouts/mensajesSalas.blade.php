@if (session('success'))
    <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@error('id_autorizacion')
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror

@error('id_usuario')
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

@error('hora_inicio')
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror

@error('hora_finalizacion')
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror

@error('actividad')
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