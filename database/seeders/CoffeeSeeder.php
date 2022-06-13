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
        $coffeeNames = [
            'Arabic Coffee',
            'Gold Coffee'
        ];
        foreach ($coffeeNames as $coffeeName) {
            Coffee::factory()->create([
                'name' => $coffeeName,
            ]);
        }
    }
}
