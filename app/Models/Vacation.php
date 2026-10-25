<?php

namespace App\Models;

use Database\Factories\VacationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'user_id',
    'package_code',
    'destination',
    'title',
    'start_date',
    'end_date',
    'travelers_count',
    'price',
    'status',
    'payment_status',
    'tier',
    'image_url',
    'notes',
    'admin_notes',
    'reviewed_by',
    'reviewed_at',
])]
class Vacation extends Model
{
    /** @use HasFactory<VacationFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'travelers_count' => 'integer',
            'price' => 'decimal:2',
            'reviewed_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the administrator who reviewed the booking.
     *
     * @return BelongsTo<User, $this>
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get all payment transactions for this vacation booking.
     *
     * @return HasMany<Payment, $this>
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the latest payment for this vacation.
     *
     * @return HasOne<Payment, $this>
     */
    public function latestPayment(): HasOne
    {
        return $this->hasOne(Payment::class)->latestOfMany();
    }

    /**
     * Check if the booking is currently pending administrator review.
     */
    public function isPendingApproval(): bool
    {
        return $this->status === 'pending_approval' || $this->status === 'pending';
    }

    /**
     * Check if the booking has been approved by an administrator.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if the booking has been completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if the booking was cancelled or rejected.
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled' || $this->status === 'rejected';
    }

    /**
     * Check if the booking was rejected by an administrator.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if payment has been fulfilled.
     */
    public function isPaid(): bool
    {
        return $this->payment_status === 'paid' || $this->status === 'paid';
    }

    /**
     * Check if the customer can proceed to make payment for this booking.
     */
    public function canBePaid(): bool
    {
        return $this->payment_status !== 'paid' && ! in_array($this->status, ['rejected', 'cancelled'], true);
    }
}
