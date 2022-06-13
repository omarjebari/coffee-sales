<?php

declare(strict_types = 1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'unit_cost' => $this->unit_cost/100,
            'profit' => $this->profit/100,
            'shipping_cost' => $this->whenLoaded('shippingCost'),
            'sale_price' => $this->sale_price/100,
            'sold_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            'coffee' => $this->whenLoaded('coffee'),
        ];
    }
}
