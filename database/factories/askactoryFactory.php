<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ask>
 */
class askactoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3), // Генерация заголовка
            'description' => $this->faker->paragraph(), // Генерация описания
            'category_id' => \App\Models\Category::factory(), // Генерация категории (связанной модели)
        ];
    }
}
