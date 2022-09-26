<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ThemeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'theme_name' => $this->faker->colorName(),
            'theme_description' => $this->faker->text(100),
            'theme_img' => $this->faker->imageUrl(500, 800, 'cars'),
            'theme_online' => $this->faker->boolean()
        ];
    }
}
