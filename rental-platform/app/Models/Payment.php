<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    /**
     * Поля, разрешённые для массового заполнения.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_id',
        'amount',
        'status',
    ];

    /**
     * Платёж принадлежит бронированию.
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}

