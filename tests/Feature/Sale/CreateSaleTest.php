<?php

namespace Tests\Feature\Sale;

use App\Models\User;
use App\Services\Interfaces\SaleServiceInterface;
use App\Services\SaleService;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateSaleTest extends TestCase
{
    use RefreshDatabase;

    protected SaleServiceInterface $saleService;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
        $this->saleService = new SaleService();
        $this->user = User::all()->first();
    }

    public function test_sale_is_stored()
    {
        Sanctum::actingAs($this->user);
        $quantity = 100;
        $unitCost = 10;
        $profitMargin = 25;
        $shippingCost = 1000;
        $salePrice = $this->saleService->calculateSalePrice($quantity, $unitCost, $profitMargin, $shippingCost);
        $profit = $this->saleService->calculateProfit($quantity, $unitCost, $salePrice, $shippingCost);
        $params = [
            'quantity' => $quantity,
            'unit_cost' => $unitCost,
        ];
        $this->actingAs($this->user)
            ->postJson(route('sales.store'), $params)
            ->assertStatus(201);
        $this->assertDatabaseHas('sales', [
                'quantity' => 100,
                'unit_cost' => 10,
                'profit_margin' => config('coffee.profit_margin'),
                'profit' => $profit,
                'shipping_cost' => config('coffee.shipping_cost'),
                'sale_price' => $salePrice,
        ]);
    }

    public function test_error_if_invalid_currency_format()
    {
        Sanctum::actingAs($this->user);
        $quantity = 100;
        $unitCost = '10.30';
        $params = [
            'quantity' => $quantity,
            'unit_cost' => $unitCost,
        ];
        $this->actingAs($this->user)
            ->postJson(route('sales.store'), $params)
            ->assertStatus(422);
        $this->assertDatabaseCount('sales', 0);
    }
}
