<?php

declare(strict_types = 1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'profit_margin' => $this->profit_margin,
            'shipping_cost' => $this->shipping_cost/100,
            'sale_price' => $this->sale_price/100,
        ];
    }
}
