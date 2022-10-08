<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "color_name" => $this->faker->colorName(),
            "color_hex" => $this->faker->hexcolor(),
            "online" => $this->faker->boolean()
        ];
    }
}
