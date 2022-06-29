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

@error('id_destinatario')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ $message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('id_origen')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ $message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('fecha_solicitud')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ $message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('id_placa')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ $message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('id_conductor')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ $message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('lugar_destino')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ $message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('fecha_detalle')
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

@error('objetivo')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ $message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('tipo_combustible')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ $message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror