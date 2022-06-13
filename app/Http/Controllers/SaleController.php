<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\Sale\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Coffee;
use App\Models\Sale;
use App\Services\Interfaces\SaleServiceInterface;
use App\Services\Interfaces\ShippingCostServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SaleController extends Controller
{
    public function sales(ShippingCostServiceInterface $shippingCostService)
    {
        // Get the latest shipping cost record
        $latestShippingCost = $shippingCostService->getLatest();

        $items = Coffee::all();
        return view('coffee_sales', [
            'items' => $items,
            'shippingCost' => $latestShippingCost->shipping_cost
        ]);
    }

    public function index(): AnonymousResourceCollection
    {
        return SaleResource::collection(Sale::with('coffee')->get());
    }

    public function store(SaleRequest $request, SaleServiceInterface $saleService, ShippingCostServiceInterface $shippingCostService): JsonResponse
    {
        // Get the latest shipping cost record
        $latestShippingCost = $shippingCostService->getLatest();

        $quantity = $request->validated('quantity');
        $unitCost = $request->validated('unit_cost');
        $coffee = Coffee::find($request->validated('coffee_id'));
        return (new SaleResource($saleService->store($quantity, $unitCost, $coffee, $latestShippingCost)))
            ->response()
            ->setStatusCode(201);
    }
}
