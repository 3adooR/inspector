<?php

namespace Database\Factories\Inspector;

use App\Models\Inspector\Code;
use Illuminate\Database\Eloquent\Factories\Factory;

class CodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Code::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $valid = $this->faker->boolean(10);
        $errors = ($valid) ? 0 : $this->faker->numberBetween(0, 100);
        return [
            'valid' => $valid,
            'errors' => $errors,
            'warnings' => $this->faker->numberBetween(0, 100),
            'result' => $this->faker->sentence
        ];
    }
}
