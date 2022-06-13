<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Coffee;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 50);
        $unitCost = $this->faker->numberBetween(1000, 2000);
        $profitMargin = $this->faker->numberBetween(1, 90);
        $shippingCost = $this->faker->numberBetween(1, 5);
        $salePrice = (($quantity * $unitCost)/(1-($profitMargin/100))) + $shippingCost;
        $profit = $salePrice - $shippingCost - ($quantity * $unitCost);
        return [
            'quantity' => $quantity,
            'unit_cost' => $unitCost,
            'profit' => $profit,
            'shipping_cost' => $shippingCost,
            'sale_price' => $salePrice,
            'coffee_id' => Coffee::factory(),
        ];
    }
}
