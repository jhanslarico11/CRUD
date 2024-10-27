<?php

namespace Tests\Feature;

use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase; // Asegúrate de que la base de datos se restablezca entre pruebas

    /** @test */
    public function puede_mostrar_el_índice_de_clientes()
    {
        // Crea algunos clientes
        Cliente::factory()->count(3)->create();

        // Realiza una solicitud GET a la ruta de clientes
        $response = $this->get(route('clientes.index'));

        // Asegúrate de que la vista contenga los clientes creados
        $response->assertStatus(200);
        $response->assertViewHas('clientes');
    }

    /** @test */
    public function puede_almacenar_un_cliente()
    {
        // Datos de prueba para el cliente
        $data = [
            'nombre' => 'Juan Pérez',
            'correo' => 'juan.perez@example.com',
            'telefono' => '123456789',
        ];

        // Realiza una solicitud POST a la ruta de agregar cliente
        $response = $this->post(route('clientes.add'), $data);

        // Asegúrate de que el cliente fue creado en la base de datos
        $this->assertDatabaseHas('clientes', $data);

        // Asegúrate de que se redirige de vuelta con un mensaje de éxito
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Cliente registrado exitosamente.');
    }

    /** @test */
    public function Puede_editar_un_cliente()
    {
        // Crea un cliente
        $cliente = Cliente::factory()->create();

        // Realiza una solicitud GET para editar el cliente
        $response = $this->get(route('clientes.edit', $cliente->id));

        // Asegúrate de que se muestre la vista correcta
        $response->assertStatus(200);
        $response->assertViewIs('clientes.edit');
        $response->assertViewHas('cliente', $cliente);
    }

    /** @test */
    public function Puede_actualizar_un_cliente()
    {
        // Crea un cliente
        $cliente = Cliente::factory()->create();

        // Datos actualizados para el cliente
        $data = [
            'nombre' => 'Juan Pérez Actualizado',
            'correo' => 'juan.actualizado@example.com',
            'telefono' => '987654321',
        ];

        // Realiza una solicitud PUT para actualizar el cliente
        $response = $this->put(route('clientes.update', $cliente->id), $data);

        // Asegúrate de que el cliente fue actualizado en la base de datos
        $this->assertDatabaseHas('clientes', $data);

        // Asegúrate de que se redirige a la lista de clientes con un mensaje de éxito
        $response->assertRedirect(route('clientes.index'));
        $response->assertSessionHas('success', 'Cliente actualizado exitosamente.');
    }

    /** @test */
    public function Puede_eliminar_un_cliente()
    {
        // Crea un cliente
        $cliente = Cliente::factory()->create();

        // Realiza una solicitud DELETE para eliminar el cliente
        $response = $this->delete(route('clientes.destroy', $cliente->id));

        // Asegúrate de que el cliente fue eliminado de la base de datos
        $this->assertDatabaseMissing('clientes', ['id' => $cliente->id]); // Cambia 'cliente' por 'clientes'

        // Asegúrate de que se redirige a la lista de clientes con un mensaje de éxito
        $response->assertRedirect(route('clientes.index'));
        $response->assertSessionHas('success', 'Cliente eliminado exitosamente.');
    }

}
