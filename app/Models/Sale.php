<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'profit_margin',
        'profit',
        'shipping_cost',
        'sale_price',
    ];
}
