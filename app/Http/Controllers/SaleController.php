<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\Sale\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Sale;
use App\Services\Interfaces\SaleServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SaleController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return SaleResource::collection(Sale::all());
    }

    public function store(SaleRequest $request, SaleServiceInterface $saleService): JsonResponse
    {
        $quantity = $request->validated('quantity');
        $unitCost = $request->validated('unit_cost');
        return (new SaleResource($saleService->store($quantity, $unitCost)))
            ->response()
            ->setStatusCode(201);
    }
}
