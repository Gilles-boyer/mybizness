<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Application::factory(5)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Role::factory(3)->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Product::factory(10)->create();
        \App\Models\PaiementMethod::factory(5)->create();
        \App\Models\Order::factory(10)->create();
        \App\Models\ProductOrder::factory(20)->create();
        \App\Models\Theme::factory(10)->create();
        \App\Models\ShippingMethod::factory(10)->create();
        \App\Models\Voucher::factory(10)->create();
    }
}
