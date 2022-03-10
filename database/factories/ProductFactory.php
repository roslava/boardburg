<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'external_id' => '007023',
            'name' => $this->faker->name,
            'description' => $this->faker->text(150),
            'img' => $this->faker->imageUrl,
            'price' => $this->faker->numberBetween(1, 5000),
            'category_id' => '4',
            'user_id' => '2',
            'slug' => 'bearings',
        ];
    }
}
