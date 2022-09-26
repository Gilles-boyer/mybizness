<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    public $tab = ['client', 'staff', 'admin'];
    public $i = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $field = [
            'role_name' => $this->tab[$this->i],
            'role_description' => $this->faker->text($maxNbChars = 100)
        ];
        $this->i ++;

        return $field;
    }
}
