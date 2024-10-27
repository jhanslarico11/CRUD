<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmpleadosController extends Controller
{

    public function index()
    {
        $empleados = Empleados::all(); // Obtener todos los empleados
        return view('layouts.app', compact('empleados')); // Asegúrate de que estés llamando la vista correcta
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $empleado = new Empleados();

        // Verificar si hay archivo avatar
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $nombrearchivo = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('avatars'), $nombrearchivo);
            $empleado->avatar = $nombrearchivo;
        }

        // Asignar los demás campos
        $empleado->nombre = $request->nombre;
        $empleado->cedula = $request->cedula;
        $empleado->edad = $request->edad;
        $empleado->sexo = $request->sexo;
        $empleado->telefono = $request->telefono;
        $empleado->cargo = $request->cargo;

        // Guardar empleado
        $empleado->save();

        return redirect()->back()->with('success', 'Empleado registrado exitosamente.');
    }



    public function show($empleado)
    {
        $empleado = Empleados::findOrFail($empleado);
        return view('empleados.show', compact('empleado'));
    }


    public function edit($idEmpleado)
    {
        $empleado = Empleados::findOrFail($idEmpleado);
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idEmpleado)
    {
        $datoEmpleado = Empleados::findOrFail($idEmpleado);

        // Verificar si se adjuntó un nuevo archivo de imagen
        if ($request->hasFile('avatar')) {
            // Eliminar la imagen anterior del servidor si existe
            if ($datoEmpleado->avatar) {
                // Eliminar la imagen anterior del servidor
                if (file_exists(public_path('avatars/' . $datoEmpleado->avatar))) {
                    unlink(public_path('avatars/' . $datoEmpleado->avatar));
                }
            }

            // Almacenar la nueva imagen en la carpeta de almacenamiento público
            $file = $request->file('avatar');
            $nombrearchivo = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('avatars'), $nombrearchivo);

            // Actualizar el nombre de la imagen en la base de datos
            $datoEmpleado->avatar = $nombrearchivo;
        }

        // Actualizar los demás campos del empleado
        $datoEmpleado->nombre = $request->nombre;
        $datoEmpleado->cedula = $request->cedula;
        $datoEmpleado->edad = $request->edad;
        $datoEmpleado->sexo = $request->sexo;
        $datoEmpleado->telefono = $request->telefono;
        $datoEmpleado->cargo = $request->cargo;
        $datoEmpleado->save();

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }


    public function destroy($idEmpleado)
    {
        $empleado = Empleados::find($idEmpleado);

        if (!$empleado) {
            return redirect()->route('empleados.index')->with('error', 'Empleado no encontrado.');
        }

        // Elimina el empleado
        $empleado->delete();

        // Elimina el archivo de imagen si existe
        if ($empleado->avatar) {
            $path = public_path('avatars/' . $empleado->avatar);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}
