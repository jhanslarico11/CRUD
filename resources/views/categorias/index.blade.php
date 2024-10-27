<div class="table-responsive">
    <table class="table table-hover" id="table_categorias">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr id="categoria_{{ $categoria->id }}">
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>{{ $categoria->descripcion }}</td>
                    <td>
                        <ul class="flex_acciones">
                            <li>
                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary" title="Editar categoría">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="post" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Desea eliminar este registro?');" title="Eliminar categoría">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
