<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_name' => $this->faker->jobTitle(),
            'category_description' => $this->faker->text($maxNbChars = 100),
            'category_icon' => "mdi-go-kart-track"
        ];
    }
}
