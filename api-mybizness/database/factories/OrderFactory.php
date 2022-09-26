<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\PaiementMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_total' => $this->faker->numberBetween(15, 259),
            'fk_client_id' => User::all()->random()->id,
            'fk_beneficiary_id' => User::all()->random()->id,
            'fk_paiement_id' => PaiementMethod::all()->random()->id,
        ];
    }
}
