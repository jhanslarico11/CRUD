<?php

namespace Tests\Feature;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PruebasTDDTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /** @test */
    public function puede_calcular_el_total_de_una_compra()
    {
        $precio = 100;
        $cantidad = 3;

        // La función `calcularTotal` debe devolver el total sin aplicar descuento
        $resultado = calcularTotal($precio, $cantidad);

        // Verificamos que el total es correcto (100 * 3 = 300)
        $this->assertEquals(300, $resultado);
    }

    /** @test */
    public function puede_calcular_el_total_con_descuento()
    {
        $precio = 100;
        $cantidad = 3;
        $descuento = 10;

        // El total con un 10% de descuento debería ser 270
        $resultado = calcularTotal($precio, $cantidad, $descuento);

        // Verificamos que el total con descuento es correcto (300 - 10% de 300 = 270)
        $this->assertEquals(270, $resultado);
    }

    /** @test */
    public function puede_calcular_stock_total()
    {
        $producto = new Producto(['stock' => 20]);

        // Queremos que la función `calcularStockTotal` devuelva el stock actual del producto
        $this->assertEquals(20, $producto->calcularStockTotal());
    }
}
