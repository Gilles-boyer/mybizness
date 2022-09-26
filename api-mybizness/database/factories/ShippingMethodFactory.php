<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shipping_name' => $this->faker->city(),
            'shipping_description' => $this->faker->realText(100, $indexSize = 2),
            'shipping_online' => $this->faker->boolean()
        ];
    }
}
