<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleados>
 */
class EmpleadosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'cedula' => $this->faker->unique()->randomNumber(8),
            'edad' => $this->faker->numberBetween(20, 60),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'telefono' => $this->faker->phoneNumber,
            'cargo' => $this->faker->jobTitle,
            'avatar' => null, // O puedes simular un archivo de avatar si lo prefieres
        ];
    }
}
