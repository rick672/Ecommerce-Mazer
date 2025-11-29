<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombre = $this->faker->unique()->randomElement([
            'Electronica',
            'Ropa y Moda',
            'Hogar y Jardin',
            'Deportes',
            'Juguetes',
            'Libros',
            'Alimentos y Bebidas',
            'Automoviles',
            'Salud y Bienestar'
        ]);

        return [
            'nombre' => $nombre,
            'slug' => Str::slug($nombre),
            'descripcion' => $this->faker->optional(0.7)->sentence(15),
        ];
    }
}
