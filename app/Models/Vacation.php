<?php

namespace App\Models;

use Database\Factories\VacationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    'tier',
    'image_url',
    'notes',
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
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
