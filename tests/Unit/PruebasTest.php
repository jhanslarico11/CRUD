<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PruebasTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_suma_correcta()
{
    $resultado = 2 + 2;
    $this->assertEquals(4, $resultado);
}
}
