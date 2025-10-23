<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_category_id',
        'image',
        'name',
        'description',
        'price',
        'rating',
        'is_popular'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::user()->role == 'store') {
                # code...
                $model->user_id = Auth::user()->id;
            }
        });

        static::updating(function ($model) {
            if (Auth::user()->role == 'store') {
                # code...
                $model->user_id = Auth::user()->id;
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function productIngredients(): HasMany
    {
        return $this->hasMany(ProductIngredient::class);
    }
}
