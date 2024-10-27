@extends('layouts.appCli')
@section('title')
    | Editar cliente
@endsection

@section('content')
<h1 class="text-center">
    <a class="float-start" title="Volver" href="{{ route('clientes.index') }}">
        <i class="bi bi-arrow-left-circle"></i>
    </a>
    Editar datos del cliente <hr>
</h1>

<form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
    @csrf
    @method("PUT")

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required value="{{ $cliente->nombre }}" />
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Correo</label>
            <input type="email" name="correo" class="form-control" required value="{{ $cliente->correo }}" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ $cliente->telefono }}" />
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn_add">
            Actualizar datos del cliente
        </button>
    </div>
</form>
@endsection
