<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Coffee;
use App\Models\Sale;
use App\Services\Interfaces\SaleServiceInterface;

class SaleService implements SaleServiceInterface
{
    public function getAll()
    {
        return Sale::all();
    }

    public function store(int $quantity, float $unitCost, Coffee $coffee)
    {
        $shippingCost = config('coffee.shipping_cost');
        $salePrice = $this->calculateSalePrice($quantity, $unitCost, (int)$coffee->profit_margin, $shippingCost);
        $profit = $this->calculateProfit($quantity, $unitCost, $salePrice, $shippingCost);
        return Sale::create([
            'quantity' => $quantity,
            'unit_cost' => $unitCost,
            'profit' => $profit,
            'shipping_cost' => $shippingCost,
            'sale_price' => $salePrice,
            'coffee_id' => $coffee->id
        ]);
    }

    public function calculateSalePrice(int $quantity, float $unitCost, int $profitMargin, int $shippingCost): int
    {
        return (int) ceil(($quantity * $unitCost) / (1 - ($profitMargin / 100)) + $shippingCost);
    }

    /**
     * Due to the rounding that occurs when calculating the sale price the profit could be more than that calculated
     * using the profitMargin alone
     * @param int $quantity
     * @param float $unitCost
     * @param int $salePrice
     * @param int $shippingCost
     * @return float
     */
    public function calculateProfit(int $quantity, float $unitCost, int $salePrice, int $shippingCost): float
    {
        return $salePrice - $shippingCost - ($quantity * $unitCost);
    }
}
