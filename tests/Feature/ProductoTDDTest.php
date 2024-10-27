<?php

namespace Tests\Feature;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ProductoTDDTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function la_tabla_productos_existe_en_la_base_de_datos()
    {
        // Verificamos que la tabla 'productos' exista en la base de datos
        $this->assertTrue(Schema::hasTable('productos'));
    }

    /** @test */
    public function la_tabla_productos_tiene_las_columnas_correctas()
    {
        // Verificamos que la tabla 'productos' tenga las columnas correctas
        $this->assertTrue(Schema::hasColumns('productos', [
            'id',
            'nombre',
            'precio',
            'stock',
            'descripcion',
            'created_at',
            'updated_at',
        ]));
    }

    /** @test */
    public function puede_verificar_si_un_producto_esta_disponible()
    {
        $producto = new Producto(['stock' => 10]);

        // Si el stock es mayor a 0, debe devolver true
        $this->assertTrue($producto->estaDisponible());

        $productoSinStock = new Producto(['stock' => 0]);

        // Si el stock es 0, debe devolver false
        $this->assertFalse($productoSinStock->estaDisponible());
    }

    /** @test */
    public function puede_calcular_el_precio_con_descuento()
    {
        $producto = new Producto(['precio' => 100]);

        // Si aplicamos un 10% de descuento, el precio final debería ser 90
        $this->assertEquals(90, $producto->calcularPrecioConDescuento(10));

        // Si aplicamos un 25% de descuento, el precio final debería ser 75
        $this->assertEquals(75, $producto->calcularPrecioConDescuento(25));
    }

    /** @test */
    public function puede_reducir_el_stock_del_producto()
    {
        $producto = new Producto(['stock' => 20]);

        // Reducimos el stock en 5 unidades
        $producto->reducirStock(5);

        // El stock debe ser 15 ahora
        $this->assertEquals(15, $producto->calcularStockTotal());

        // Reducimos el stock en 10 unidades más
        $producto->reducirStock(10);

        // El stock debe ser 5 ahora
        $this->assertEquals(5, $producto->calcularStockTotal());
    }
    /** @test */
    public function puede_verificar_si_hay_stock_suficiente()
    {
        $producto = new Producto(['stock' => 20]);

        // Si queremos comprar 15 unidades, debe devolver true
        $this->assertTrue($producto->tieneStockSuficiente(15));

        // Si queremos comprar 25 unidades, debe devolver false
        $this->assertFalse($producto->tieneStockSuficiente(25));
    }
}
