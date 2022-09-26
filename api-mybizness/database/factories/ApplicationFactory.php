<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'app_name' => $this->faker->city(),
            'app_host'=> $this->faker->domainName(),
            'app_token' => $this->faker->sha256(),
        ];
    }
}
