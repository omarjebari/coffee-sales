<?php

namespace Tests\Feature\ShippingCost;

use App\Models\Coffee;
use App\Models\ShippingCost;
use App\Models\User;
use App\Services\Interfaces\SaleServiceInterface;
use App\Services\Interfaces\ShippingCostServiceInterface;
use App\Services\SaleService;
use App\Services\ShippingCostService;
use Database\Seeders\CoffeeSeeder;
use Database\Seeders\ShippingCostSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetShippingCostsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_get_shipping_costs_with_sales_count()
    {
        $this->markTestSkipped('TODO');
    }
}
