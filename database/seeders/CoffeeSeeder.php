<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Coffee;
use Illuminate\Database\Seeder;

class CoffeeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Coffee::factory()->create([
            'name' => 'Gold Coffee',
            'profit_margin' => 25,
        ]);
        Coffee::factory()->create([
            'name' => 'Arabic Coffee',
            'profit_margin' => 15,
        ]);
    }
}
