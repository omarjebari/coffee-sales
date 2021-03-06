<?php

namespace Tests\Unit\Services\SaleService;

use App\Services\Interfaces\SaleServiceInterface;
use App\Services\SaleService;
use PHPUnit\Framework\TestCase;

class CalculateSalePriceTest extends TestCase
{
    protected SaleServiceInterface $saleService;
    protected int $profitMargin;
    protected int $shippingCost;

    protected function setUp(): void
    {
        parent::setUp();
        $this->saleService = new SaleService();
        $this->profitMargin = 25;
        $this->shippingCost = 1000;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_calculate_sale_price_matrix()
    {
        $inputs = [
            ['quantity' => 1, 'unit_cost' => 1000, 'expectedSalePrice' => 2334],
            ['quantity' => 2, 'unit_cost' => 2050, 'expectedSalePrice' => 6467],
            ['quantity' => 5, 'unit_cost' => 1200, 'expectedSalePrice' => 9000],
        ];

        foreach ($inputs as $inputArr) {
            $salePrice = $this->saleService->calculateSalePrice($inputArr['quantity'], $inputArr['unit_cost'], $this->profitMargin, $this->shippingCost);
            $this->assertEquals($inputArr['expectedSalePrice'], $salePrice);
        }
    }
}
