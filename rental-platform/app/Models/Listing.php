<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listing extends Model
{
    use HasFactory;

    /**
     * Поля, разрешённые для массового заполнения.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'user_id',
    ];

    /**
     * Объявление принадлежит пользователю (владелец).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * У объявления может быть много бронирований.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

