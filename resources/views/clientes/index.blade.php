
<div class="table-responsive">
    <table class="table table-hover" id="table_empleados">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Telefono</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr id="cliente_{{ $cliente->id }}">
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->correo }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>
                        <ul class="flex_acciones">
                            {{-- <li>
                                <a title="Ver detalles del cliente" href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-success"><i class="bi bi-binoculars"></i></a>
                            </li> --}}
                            <li>
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                            </li>
                            <li>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Desea eliminar este registro?');"><i class="bi bi-trash"></i></button>
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
