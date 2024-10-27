<?php

namespace Tests\Feature;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_mostrar_el_indice_de_productos()
    {
        // Crea algunos productos
        Producto::factory()->count(3)->create();

        // Realiza una solicitud GET a la ruta de productos
        $response = $this->get(route('productos.index'));

        // Asegúrate de que la vista contenga los productos creados
        $response->assertStatus(200);
        $response->assertViewHas('productos');
    }

    /** @test */
    public function puede_almacenar_un_producto()
    {
        // Datos de prueba para el producto
        $data = [
            'nombre' => 'Producto Test',
            'precio' => 100.00,
            'stock' => 10,
            'descripcion' => 'Descripción de prueba',
        ];

        // Realiza una solicitud POST a la ruta de agregar producto
        $response = $this->post(route('productos.add'), $data);

        // Asegúrate de que el producto fue creado en la base de datos
        $this->assertDatabaseHas('productos', $data);

        // Asegúrate de que se redirige de vuelta con un mensaje de éxito
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Producto registrado exitosamente.');
    }

    /** @test */
    public function puede_editar_un_producto()
    {
        // Crea un producto
        $producto = Producto::factory()->create();

        // Realiza una solicitud GET para editar el producto
        $response = $this->get(route('productos.edit', $producto->id));

        // Asegúrate de que se muestre la vista correcta
        $response->assertStatus(200);
        $response->assertViewIs('productos.edit');
        $response->assertViewHas('producto', $producto);
    }

    /** @test */
    public function puede_actualizar_un_producto()
    {
        // Crea un producto
        $producto = Producto::factory()->create();

        // Datos actualizados para el producto
        $data = [
            'nombre' => 'Producto Test Actualizado',
            'precio' => 150.00,
            'stock' => 20,
            'descripcion' => 'Descripción actualizada',
        ];

        // Realiza una solicitud PUT para actualizar el producto
        $response = $this->put(route('productos.update', $producto->id), $data);

        // Asegúrate de que el producto fue actualizado en la base de datos
        $this->assertDatabaseHas('productos', $data);

        // Asegúrate de que se redirige a la lista de productos con un mensaje de éxito
        $response->assertRedirect(route('productos.index'));
        $response->assertSessionHas('success', 'Producto actualizado exitosamente.');
    }

    /** @test */
    public function puede_eliminar_un_producto()
    {
        // Crea un producto
        $producto = Producto::factory()->create();

        // Realiza una solicitud DELETE para eliminar el producto
        $response = $this->delete(route('productos.destroy', $producto->id));

        // Asegúrate de que el producto fue eliminado de la base de datos
        $this->assertDatabaseMissing('productos', ['id' => $producto->id]);

        // Asegúrate de que se redirige a la lista de productos con un mensaje de éxito
        $response->assertRedirect(route('productos.index'));
        $response->assertSessionHas('success', 'Producto eliminado exitosamente.');
    }
}
