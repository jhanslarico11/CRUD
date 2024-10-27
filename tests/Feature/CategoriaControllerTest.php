<?php

namespace Tests\Feature;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaControllerTest extends TestCase
{
    use RefreshDatabase; // Asegúrate de que la base de datos se restablezca entre pruebas

    /** @test */
    public function puede_mostrar_el_índice_de_categorias()
    {
        // Crea algunas categorías
        Categoria::factory()->count(3)->create();

        // Realiza una solicitud GET a la ruta de categorías
        $response = $this->get(route('categorias.index'));

        // Asegúrate de que la vista contenga las categorías creadas
        $response->assertStatus(200);
        $response->assertViewHas('categorias');
    }

    /** @test */
    public function puede_almacenar_una_categoria()
    {
        // Datos de prueba para la categoría
        $data = [
            'nombre' => 'Tecnología',
            'descripcion' => 'Categoría para productos tecnológicos',
        ];

        // Realiza una solicitud POST a la ruta de agregar categoría
        $response = $this->post(route('categorias.add'), $data);

        // Asegúrate de que la categoría fue creada en la base de datos
        $this->assertDatabaseHas('categorias', $data);

        // Asegúrate de que se redirige de vuelta con un mensaje de éxito
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Categoría registrada exitosamente.');
    }

    /** @test */
    public function puede_editar_una_categoria()
    {
        // Crea una categoría
        $categoria = Categoria::factory()->create();

        // Realiza una solicitud GET para editar la categoría
        $response = $this->get(route('categorias.edit', $categoria->id));

        // Asegúrate de que se muestre la vista correcta
        $response->assertStatus(200);
        $response->assertViewIs('categorias.edit');
        $response->assertViewHas('categoria', $categoria);
    }

    /** @test */
    public function puede_actualizar_una_categoria()
    {
        // Crea una categoría
        $categoria = Categoria::factory()->create();

        // Datos actualizados para la categoría
        $data = [
            'nombre' => 'Electrodomésticos',
            'descripcion' => 'Categoría para productos de hogar',
        ];

        // Realiza una solicitud PUT para actualizar la categoría
        $response = $this->put(route('categorias.update', $categoria->id), $data);

        // Asegúrate de que la categoría fue actualizada en la base de datos
        $this->assertDatabaseHas('categorias', $data);

        // Asegúrate de que se redirige a la lista de categorías con un mensaje de éxito
        $response->assertRedirect(route('categorias.index'));
        $response->assertSessionHas('success', 'Categoría actualizada exitosamente.');
    }

    /** @test */
    public function puede_eliminar_una_categoria()
    {
        // Crea una categoría
        $categoria = Categoria::factory()->create();

        // Realiza una solicitud DELETE para eliminar la categoría
        $response = $this->delete(route('categorias.destroy', $categoria->id));

        // Asegúrate de que la categoría fue eliminada de la base de datos
        $this->assertDatabaseMissing('categorias', ['id' => $categoria->id]);

        // Asegúrate de que se redirige a la lista de categorías con un mensaje de éxito
        $response->assertRedirect(route('categorias.index'));
        $response->assertSessionHas('success', 'Categoría eliminada exitosamente.');
    }
}
