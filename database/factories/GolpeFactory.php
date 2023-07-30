<?php

namespace Database\Factories;

use App\Models\Faixa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Golpe>
 */
class GolpeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->word,
            'urlPath' => fake()->slug,
            'tempo' => fake()->time(),
            'descricao' => fake()->sentence,
            'url' => fake()->url,
            'detalhes' => fake()->paragraph,
            'faixa_id' => Faixa::factory(),
            "created_at" => $this->faker->dateTime(),
            "updated_at" => $this->faker->dateTime(),
        ];
    }
}
