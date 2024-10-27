<?php

namespace App\Http\Controllers;

use App\Models\Producto; // Asegúrate de tener el modelo Producto creado
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Muestra la lista de productos
    public function index()
    {
        $productos = Producto::all(); // Obtener todos los productos
        return view('layouts.appPro', compact('productos')); // Asegúrate de que estés llamando la vista correcta
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del request
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'nullable|string',
        ]);

        // Crear una nueva instancia de Producto
        $producto = new Producto();

        // Asignar los campos
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;

        // Guardar producto
        $producto->save();

        return redirect()->back()->with('success', 'Producto registrado exitosamente.');
    }

    // Muestra el formulario de edición
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del request
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'nullable|string',
        ]);

        $producto = Producto::findOrFail($id);

        // Actualizar los campos del producto
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;

        // Guardar los cambios
        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado.');
        }

        // Elimina el producto
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
