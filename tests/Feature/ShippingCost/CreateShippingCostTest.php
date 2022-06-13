<?php

namespace Tests\Feature\ShippingCost;

use App\Models\Coffee;
use App\Models\ShippingCost;
use App\Models\User;
use App\Services\Interfaces\ShippingCostServiceInterface;
use App\Services\ShippingCostService;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateShippingCostTest extends TestCase
{
    use RefreshDatabase;

    protected ShippingCostServiceInterface $saleService;
    protected User $user;
    protected Coffee $coffee;
    protected ShippingCost $shippingCost;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
        $this->shippingCostService = new ShippingCostService();
        $this->user = User::all()->first();
    }

    public function test_shipping_cost_is_stored()
    {
        Sanctum::actingAs($this->user);
        $shippingCost = 3000;
        $params = [
            'shipping_cost' => $shippingCost,
        ];
        $this->actingAs($this->user)
            ->postJson(route('shipping-costs.store'), $params)
            ->assertStatus(201);
        $this->assertDatabaseHas('shipping_costs', [
                'shipping_cost' => $shippingCost,
        ]);
    }

    public function test_error_if_invalid_currency_format()
    {
        Sanctum::actingAs($this->user);
        $shippingCost = '10.30';
        $params = [
            'shipping_cost' => $shippingCost,
        ];
        $this->actingAs($this->user)
            ->postJson(route('shipping-costs.store'), $params)
            ->assertStatus(422);
        $this->assertDatabaseCount('shipping_costs', 0);
    }
}
