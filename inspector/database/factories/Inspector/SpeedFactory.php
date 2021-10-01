<?php

namespace Database\Factories\Inspector;

use App\Models\Inspector\Speed;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpeedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Speed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'time' => $this->faker->numberBetween(1, 5),
            'count_js' => $this->faker->numberBetween(1, 5),
            'count_css' => $this->faker->numberBetween(1, 5),
            'count_images' => $this->faker->numberBetween(1, 5),
            'count_css_images' => $this->faker->numberBetween(1, 5),
            'weight_page' => $this->faker->numberBetween(1, 5),
            'weight_js' => $this->faker->numberBetween(1, 5),
            'weight_css' => $this->faker->numberBetween(1, 5),
            'weight_images' => $this->faker->numberBetween(1, 5),
            'weight_css_images' => $this->faker->numberBetween(1, 5)
        ];
    }
}
