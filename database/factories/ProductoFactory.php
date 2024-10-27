<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(), // Genera un nombre aleatorio
            'precio' => $this->faker->randomFloat(2, 1, 100), // Genera un precio entre 1 y 100
            'stock' => $this->faker->numberBetween(0, 100), // Genera un stock entre 0 y 100
            'descripcion' => $this->faker->sentence(), // Genera una descripción aleatoria
        ];
    }
}
