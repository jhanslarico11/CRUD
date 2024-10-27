<?php

namespace App\Http\Controllers;

use App\Models\Categoria; // Asegúrate de tener el modelo Categoria creado
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all(); // Obtener todas las categorías
        return view('layouts.appCat', compact('categorias')); // Asegúrate de que estés llamando la vista correcta
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoria = new Categoria();

        // Asignar los campos
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion; // Asumiendo que tienes un campo de descripción

        // Guardar categoría
        $categoria->save();

        return redirect()->back()->with('success', 'Categoría registrada exitosamente.');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        // Actualizar los campos de la categoría
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion; // Asumiendo que tienes un campo de descripción
        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return redirect()->route('categorias.index')->with('error', 'Categoría no encontrada.');
        }

        // Elimina la categoría
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
