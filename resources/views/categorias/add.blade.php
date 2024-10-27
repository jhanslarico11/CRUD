<form action="{{ route('categorias.add') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" required />
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control"></textarea>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn_add">
            Registrar Categoría
        </button>
    </div>
</form>
