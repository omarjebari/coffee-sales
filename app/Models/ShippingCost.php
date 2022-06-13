<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShippingCost extends Model
{
    use HasFactory;

    protected $table = 'shipping_costs';

    protected $fillable = [
        'shipping_cost',
    ];
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
