<?php

declare(strict_types = 1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ShippingCostResource extends JsonResource
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
            'shipping_cost' => $this->shipping_cost/100,
            'set_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            'sales_count' => isset($this->sales_count) ? $this->sales_count: 0
        ];
    }
}
