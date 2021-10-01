<?php

namespace Database\Factories\Inspector;

use App\Models\Inspector\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'parent' => 0,
            'code' => $this->faker->randomElement([200, 404, 301]),
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'keywords' => implode(', ', $this->faker->words),
            'h1' => $this->faker->sentence,
            'parsed' => 0
        ];
    }
}
