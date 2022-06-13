<?php

declare(strict_types = 1);

namespace App\Services\Interfaces;

interface ShippingCostServiceInterface
{
    public function getLatest();
    public function getOrderedByLatestWithNumSales();
    public function store(int $shippingCost);
}
