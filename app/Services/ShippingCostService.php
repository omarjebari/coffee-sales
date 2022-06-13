<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\ShippingCost;
use App\Services\Interfaces\ShippingCostServiceInterface;

class ShippingCostService implements ShippingCostServiceInterface
{
    public function getLatest()
    {
        return ShippingCost::all()->sortByDesc('id')->first();
    }

    public function getOrderedByLatestWithNumSales()
    {
        return ShippingCost::withCount('sales')->orderBy('id', 'desc')->get();
    }

    public function store(int $shippingCost)
    {
        return ShippingCost::create([
            'shipping_cost' => $shippingCost,
        ]);
    }
}
