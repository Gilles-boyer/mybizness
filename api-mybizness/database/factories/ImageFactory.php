<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image_name' => $this->faker->lastName(),
            'image_src' => $this->faker->imageUrl($width = 600, $height = 800),
            'image_description'  =>$this->faker->text(100)
        ];
    }
}
