<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FontFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'font_name' => $this->faker->lastName(),
            'font_font' => "Roboto",
        ];
    }
}
