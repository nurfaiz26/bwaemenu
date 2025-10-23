<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductIngredient extends Model
{
    /** @use HasFactory<\Database\Factories\ProductIngredientFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'name'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
