<?php

namespace Tests\Feature\Sale;

use App\Models\Coffee;
use App\Models\ShippingCost;
use App\Models\User;
use App\Services\Interfaces\SaleServiceInterface;
use App\Services\SaleService;
use App\Services\ShippingCostService;
use Database\Seeders\CoffeeSeeder;
use Database\Seeders\ShippingCostSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateSaleTest extends TestCase
{
    use RefreshDatabase;

    protected SaleServiceInterface $saleService;
    protected User $user;
    protected Coffee $coffee;
    protected ShippingCost $shippingCost;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
        $this->seed(CoffeeSeeder::class);
        $this->seed(ShippingCostSeeder::class);
        $this->saleService = new SaleService();
        $this->shippingCostService = new ShippingCostService();
        $this->user = User::all()->first();
        $this->coffee = Coffee::all()->first();
        $this->shippingCost = $this->shippingCostService->getLatest();
    }

    public function test_sale_is_stored()
    {
        Sanctum::actingAs($this->user);
        $quantity = 100;
        $unitCost = 10;
        $profitMargin = $this->coffee->profit_margin;
        $salePrice = $this->saleService->calculateSalePrice($quantity, $unitCost, $profitMargin, $this->shippingCost->shipping_cost);
        $profit = $this->saleService->calculateProfit($quantity, $unitCost, $salePrice, $this->shippingCost->shipping_cost);
        $params = [
            'quantity' => $quantity,
            'unit_cost' => $unitCost,
            'coffee_id' => $this->coffee->id
        ];
        $this->actingAs($this->user)
            ->postJson(route('sales.store'), $params)
            ->assertStatus(201);
        $this->assertDatabaseHas('sales', [
                'quantity' => 100,
                'unit_cost' => 10,
                'profit' => $profit,
                'shipping_cost_id' => $this->shippingCost->id,
                'sale_price' => $salePrice,
                'coffee_id'=> $this->coffee->id
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
            'coffee_id' => $this->coffee->id
        ];
        $this->actingAs($this->user)
            ->postJson(route('sales.store'), $params)
            ->assertStatus(422);
        $this->assertDatabaseCount('sales', 0);
    }
}
