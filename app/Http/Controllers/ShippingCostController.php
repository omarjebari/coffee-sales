<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\ShippingCost\ShippingCostRequest;
use App\Http\Resources\ShippingCostResource;
use App\Services\Interfaces\ShippingCostServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ShippingCostController extends Controller
{
    public function shippingPartners(ShippingCostServiceInterface $shippingCostService)
    {
        // Get the latest shipping cost record
        $latestShippingCost = $shippingCostService->getLatest();

        //$items = Coffee::all();
        return view('shipping_partners', [
            'shippingCost' => $latestShippingCost->shipping_cost
        ]);
    }

    public function index(ShippingCostServiceInterface $shippingCostService): AnonymousResourceCollection
    {
        return ShippingCostResource::collection($shippingCostService->getOrderedByLatestWithNumSales());
    }

    public function store(ShippingCostRequest $request, ShippingCostServiceInterface $shippingCostService): JsonResponse
    {
        $shippingCost = (int)$request->validated('shipping_cost');
        return (new ShippingCostResource($shippingCostService->store($shippingCost)))
            ->response()
            ->setStatusCode(201);
    }
}
