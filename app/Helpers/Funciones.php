<?php

if (!function_exists('calcularTotal')) {
    function calcularTotal($precio, $cantidad, $descuento = 0)
    {
        $total = $precio * $cantidad;
        return $total - ($total * $descuento / 100);
    }
}

