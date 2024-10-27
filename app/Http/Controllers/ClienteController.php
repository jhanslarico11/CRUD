<?php

namespace App\Http\Controllers;

use App\Models\Cliente; // Asegúrate de tener el modelo Cliente creado
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all(); // Obtener todos los clientes
        return view('layouts.appCli', compact('clientes')); // Asegúrate de que estés llamando la vista correcta
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();

        // Asignar los campos
        $cliente->nombre = $request->nombre;
        $cliente->correo = $request->correo; // Asumiendo que tienes un campo de correo
        $cliente->telefono = $request->telefono; // Teléfono es opcional, así que puede no ser necesario

        // Guardar cliente
        $cliente->save();

        return redirect()->back()->with('success', 'Cliente registrado exitosamente.');
    }

    // public function show($id)
    // {
    //     $cliente = Cliente::findOrFail($id);
    //     return view('clientes.show', compact('clientes'));
    // }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        // Actualizar los campos del cliente
        $cliente->nombre = $request->nombre;
        $cliente->correo = $request->correo; // Asumiendo que tienes un campo de correo
        $cliente->telefono = $request->telefono; // Teléfono es opcional, así que puede no ser necesario
        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->route('clientes.index')->with('error', 'Cliente no encontrado.');
        }

        // Elimina el cliente
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
