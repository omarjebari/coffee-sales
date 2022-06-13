<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ShippingCost;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingCostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShippingCost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'shipping_cost' => $this->faker->numberBetween(1, 5),
        ];
    }
}
