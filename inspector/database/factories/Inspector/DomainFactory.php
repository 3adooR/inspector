<?php

namespace Database\Factories\Inspector;

use App\Models\Inspector\Domain;
use Illuminate\Database\Eloquent\Factories\Factory;

class DomainFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Domain::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'data' => json_encode([
                $this->faker->word => $this->faker->sentence
            ])
        ];
    }
}
