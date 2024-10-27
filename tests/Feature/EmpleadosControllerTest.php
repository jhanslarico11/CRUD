<?php

namespace Tests\Feature;

use App\Models\Empleados;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class EmpleadosControllerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function puede_listar_empleados()
    {
        // Crear algunos empleados en la base de datos
        Empleados::factory()->count(3)->create();

        // Simular una solicitud GET al método index
        $response = $this->get(route('empleados.index'));

        // Asegurarse de que la respuesta es exitosa
        $response->assertStatus(200);

        // Asegurarse de que la vista se devuelve con empleados
        $response->assertViewHas('empleados');
    }

    /** @test */
    public function puede_registrar_nuevo_empleado()
    {
        // Simular una solicitud POST con datos válidos
        $data = [
            'nombre' => 'Juan Pérez',
            'cedula' => '12345678',
            'edad' => 30,
            'sexo' => 'M',
            'telefono' => '12345678',
            'cargo' => 'Desarrollador',
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
        ];

        $response = $this->post(route('myStore'), $data);

        // Asegurarse de que el empleado ha sido guardado
        $this->assertDatabaseHas('empleados', [
            'nombre' => 'Juan Pérez',
            'cedula' => '12345678',
        ]);

        // Verificar redirección con mensaje de éxito
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Empleado registrado exitosamente.');
    }

    /** @test */
    public function puede_mostrar_detalles_del_empleado()
    {
        // Crear un empleado en la base de datos
        $empleado = Empleados::factory()->create();

        // Simular una solicitud GET para mostrar los detalles del empleado
        $response = $this->get(route('myShow', $empleado->id));

        // Verificar que la respuesta es exitosa
        $response->assertStatus(200);

        // Verificar que la vista tiene el empleado correcto
        $response->assertViewHas('empleado', $empleado);

        // También podrías verificar si el contenido de la vista contiene el nombre del empleado
        $response->assertSee($empleado->nombre);
    }

    /** @test */
    public function puede_actualizar_empleado()
    {
        // Crear un empleado en la base de datos
        $empleado = Empleados::factory()->create();

        // Datos para actualizar
        $data = [
            'nombre' => 'Carlos López',
            'cedula' => '87654321',
            'edad' => 35,
            'sexo' => 'M',
            'telefono' => '987654321',
            'cargo' => 'Gerente',
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
        ];

        $response = $this->put(route('myUpdate', $empleado->id), $data);

        // Asegurarse de que el empleado ha sido actualizado en la base de datos
        $this->assertDatabaseHas('empleados', ['nombre' => 'Carlos López']);

        // Verificar redirección con mensaje de éxito
        $response->assertRedirect(route('empleados.index'));
        $response->assertSessionHas('success', 'Empleado actualizado exitosamente.');
    }

    /** @test */
    public function puede_mostrar_la_vista_de_edicion_del_empleado()
    {
        // Crear un empleado en la base de datos
        $empleado = Empleados::factory()->create();

        // Simular una solicitud GET para editar al empleado
        $response = $this->get(route('myEdit', $empleado->id));

        // Verificar que la respuesta es exitosa
        $response->assertStatus(200);

        // Verificar que la vista tiene el empleado correcto
        $response->assertViewHas('empleado', $empleado);

        // También podrías verificar si el contenido de la vista contiene el nombre del empleado
        $response->assertSee($empleado->nombre);
    }

    /** @test */
    public function puede_eliminar_empleado()
    {
        // Crear un empleado en la base de datos
        $empleado = Empleados::factory()->create();

        // Simular una solicitud DELETE para eliminar al empleado
        $response = $this->delete(route('myDestroy', $empleado->id));

        // Verificar que el empleado ha sido eliminado de la base de datos
        $this->assertDatabaseMissing('empleados', ['id' => $empleado->id]);

        // Verificar redirección con mensaje de éxito
        $response->assertRedirect(route('empleados.index'));
        $response->assertSessionHas('success', 'Empleado eliminado exitosamente.');
    }
}
