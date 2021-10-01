<?php

namespace Database\Factories\Inspector;

use App\Models\Inspector\Server;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Server::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'ip' => $this->faker->ipv4,
            'lat' => $this->faker->latitude,
            'long' => $this->faker->longitude,
            'data' => json_encode([
                $this->faker->word => $this->faker->sentence
            ])
        ];
    }
}
