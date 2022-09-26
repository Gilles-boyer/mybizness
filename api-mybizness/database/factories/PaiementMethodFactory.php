<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaiementMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'paiement_name' => $this->faker->word(),
            'paiement_description' => $this->faker->realText(100, 1),
        ];
    }
}
