<div class="table-responsive">
    <table class="table table-hover" id="table_productos">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
                <th scope="col">Descripción</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr id="producto_{{ $producto->id }}">
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->precio }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>
                        <ul class="flex_acciones">
                            <li>
                                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary" title="Editar producto"><i class="bi bi-pencil-square"></i></a>
                            </li>
                            <li>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Desea eliminar este producto?');" title="Eliminar producto"><i class="bi bi-trash"></i></button>
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
