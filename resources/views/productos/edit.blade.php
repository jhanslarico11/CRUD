@extends('layouts.appPro') <!-- Cambia esto si tu layout es diferente -->
@section('title')
    | Editar producto
@endsection

@section('content')
<h1 class="text-center">
    <a class="float-start" title="Volver" href="{{ route('productos.index') }}">
        <i class="bi bi-arrow-left-circle"></i>
    </a>
    Editar datos del producto <hr>
</h1>

<form action="{{ route('productos.update', $producto->id) }}" method="POST">
    @csrf
    @method("PUT")

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required value="{{ $producto->nombre }}" />
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="precio" class="form-control" required step="0.01" value="{{ $producto->precio }}" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" required value="{{ $producto->stock }}" />
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $producto->descripcion }}</textarea>
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn_add">
            Actualizar datos del producto
        </button>
    </div>
</form>
@endsection
