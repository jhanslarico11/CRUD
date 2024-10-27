@extends('layouts.appCli')

@section('title')
    | Editar categoría
@endsection

@section('content')
<h1 class="text-center">
    <a class="float-start" title="Volver" href="{{ route('categorias.index') }}">
        <i class="bi bi-arrow-left-circle"></i>
    </a>
    Editar datos de la categoría <hr>
</h1>

<form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
    @csrf
    @method("PUT")

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required value="{{ $categoria->nombre }}" />
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $categoria->descripcion }}</textarea>
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn_add">
            Actualizar datos de la categoría
        </button>
    </div>
</form>
@endsection
