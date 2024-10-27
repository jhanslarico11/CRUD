<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['precio', 'stock'];
    use HasFactory;
    public function calcularStockTotal()
    {
        return $this->stock;
    }
    public function estaDisponible()
    {
        return $this->stock > 0;
    }
    public function calcularPrecioConDescuento($descuento)
    {
        $precioFinal = $this->precio - ($this->precio * $descuento / 100);
        return $precioFinal;
    }
    public function reducirStock($cantidad)
    {
        $this->stock -= $cantidad;
    }
    public function tieneStockSuficiente($cantidad)
    {
        return $this->stock >= $cantidad;
    }
}
