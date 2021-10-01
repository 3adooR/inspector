<?php

namespace Database\Factories\Inspector;

use App\Models\Inspector\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Site::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'host' => $this->faker->domainName,
            'https' => $this->faker->boolean(30)
        ];
    }
}
