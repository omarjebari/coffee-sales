<?php

declare(strict_types = 1);

namespace App\Http\Requests\ShippingCost;

use Illuminate\Foundation\Http\FormRequest;

class ShippingCostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'shipping_cost' => 'required|integer',
        ];
    }
}
