<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'end_date',
        'is_active',
    ];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    protected function subscriptionPayment(): HasOne 
    {
        return $this->hasOne(SubscriptionPayment ::class);
    }
}
