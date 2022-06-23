@if (session('success'))
<div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('errorHora'))
<div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
    {{session('errorHora')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('errorFecha'))
<div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
    {{session('errorFecha')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@error('id_organizador')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ $message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('id_coordinador')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ $message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('id_estado')
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

@error('nombre_actividad')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ $message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('fecha_inicio')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ $message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('fecha_finalizacion')
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