<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPayment extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionPaymentFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subscription_id',
        'proof',
        'status'
    ];

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
