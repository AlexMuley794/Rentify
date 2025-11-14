<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'notes'];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
