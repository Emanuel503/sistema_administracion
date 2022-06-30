@if (session('success'))
<div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@error('nombre')
<div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
    {{$message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('codigo')
<div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
    {{$message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@if (session('errorEliminar'))
<div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
    {{session('errorEliminar')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif