<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $code
 * @property string $name
 * @property int $id
 */
class Coffee extends Model
{
    use HasFactory;

    protected $table = 'coffees';

    protected $fillable = [
        'name',
        'profit_margin',
    ];
}
