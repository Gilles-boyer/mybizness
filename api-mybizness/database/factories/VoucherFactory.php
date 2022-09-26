<?php

namespace Database\Factories;

use DateTime;
use App\Models\Order;
use App\Models\ShippingMethod;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $today= new DateTime();
        return [
            'voucher_num' => $this->faker->uuid(),
            'voucher_validity' => date_add($today, date_interval_create_from_date_string("90 days"))->format('d-m-y'),
            'voucher_message' => $this->faker->realText(100, 1),
            'voucher_color' => $this->faker->hexcolor(),
            'voucher_font' => $this->faker->jobTitle(),
            'fk_order_id' => Order::all()->random()->id,
            'fk_theme_id' => Theme::all()->random()->id,
            'fk_shipping_id' => ShippingMethod::all()->random()->id,
        ];
    }
}
