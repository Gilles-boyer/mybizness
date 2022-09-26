<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->city(),
            'product_description' => $this->faker->realText(150 , 1),
            'product_img' => $this->faker->imageUrl(500, 500),
            'product_price' => $this->faker->buildingNumber(),
            'product_online' => $this->faker->boolean(),
            'fk_category_id' => Category::all()->random()->id
        ];
    }
}
