<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SkateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'external_id' =>$this->faker->numberBetween(800,900),
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(30),
            'img' => $this->faker->imageUrl(),
            'price'=> $this->faker->numberBetween(100,200000),
            'category_id'=> $this->faker->numberBetween(1,3),
        ];
    }
}









