<?php

namespace Database\Factories;

use App\Models\Faixa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kata>
 */
class KataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id" => $this->faker->uuid(),
            "nome" => $this->faker->name(),
            "faixa_id" => Faixa::factory(),
            "url" => $this->faker->url(),
            "descricao" => $this->faker->text(),
            "created_at" => $this->faker->dateTime(),
            "updated_at" => $this->faker->dateTime(),
        ];
    }
}
