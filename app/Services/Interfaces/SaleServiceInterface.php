<?php

declare(strict_types = 1);

namespace App\Services\Interfaces;

use App\Models\Coffee;

interface SaleServiceInterface
{
    public function getAll();
    public function store(int $quantity, float $unitCost, Coffee $coffee);
    public function calculateSalePrice(int $quantity, float $unitCost, int $profitMargin, int $shippingCost);
    public function calculateProfit(int $quantity, float $unitCost, int $salePrice, int $shippingCost);
}
