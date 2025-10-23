<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    /** @use HasFactory<\Database\Factories\ProductCategoryFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'icon'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::user()->role == 'store') {
                # code...
                $model->user_id = Auth::user()->id;
            }

            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            if (Auth::user()->role == 'store') {
                # code...
                $model->user_id = Auth::user()->id;
            }

            $model->slug = Str::slug($model->name);
        });
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
