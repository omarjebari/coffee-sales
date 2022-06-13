<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $code
 * @property string $name
 * @property int $id
 */
class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'quantity',
        'unit_cost',
        'profit',
        'shipping_cost',
        'sale_price',
        'coffee_id'
    ];

    public function coffee(): BelongsTo
    {
        return $this->belongsTo(Coffee::class);
    }
}
