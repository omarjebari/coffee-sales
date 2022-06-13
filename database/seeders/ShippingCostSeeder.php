<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ShippingCost;
use Illuminate\Database\Seeder;

class ShippingCostSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ShippingCost::factory()->create([
            'shipping_cost' => 1000,
        ]);
        ShippingCost::factory()->create([
            'shipping_cost' => 2000,
        ]);
    }
}
