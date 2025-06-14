<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    /**
     * Поля, разрешённые для массового заполнения.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'listing_id',
        'user_id',
        'from_date',
        'to_date',
    ];

    /**
     * Бронирование принадлежит объявлению.
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    /**
     * Бронирование принадлежит пользователю.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * У бронирования может быть один платёж.
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
