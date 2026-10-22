<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'booking_code',
        'user_id',
        'package_id',
        'trip_date',
        'adult_count',
        'child_count',
        'total_price',
        'contact_name',
        'contact_email',
        'contact_phone',
        'participants',
        'special_notes',
        'payment_method',
        'payment_status',
        'payment_receipt',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'trip_date' => 'date',
            'participants' => 'array',
            'total_price' => 'float',
            'adult_count' => 'integer',
            'child_count' => 'integer',
        ];
    }

    /**
     * Get the package that was booked.
     *
     * @return BelongsTo<Package, $this>
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the customer/user who made the booking.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
