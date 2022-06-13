<?php

declare(strict_types = 1);

namespace App\Services\Interfaces;

interface SaleServiceInterface
{
    public function getAll();
    public function store(int $quantity, float $unitCost);
    public function calculateSalePrice(int $quantity, float $unitCost, int $profitMargin, int $shippingCost);
    public function calculateProfit(int $quantity, float $unitCost, int $salePrice, int $shippingCost);
}
