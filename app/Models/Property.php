<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $fillable = [
        'user_id',
        'title', 
        'address',
        'type',
        'price',
        'description',
        'image_path',
    ];

    protected $casts = [
        'type' => \App\Enums\PropertyType::class,
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Accessors & Helpers
    public function getIsOccupiedAttribute(): bool
    {
        // Check if there is any active reservation for today
        return $this->reservations()
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->exists();
    }

    public function getCurrentTenantAttribute()
    {
        $reservation = $this->reservations()
            ->with('tenant')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        return $reservation ? $reservation->tenant : null;
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->is_occupied ? 'Ocupada' : 'Disponible';
    }

    public function getStatusColorAttribute(): string
    {
        return $this->is_occupied ? 'red' : 'green';
    }

    public function getStatusAttribute(): string
    {
        return $this->is_occupied ? 'occupied' : 'available';
    }
}
