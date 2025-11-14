<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'property_id',
        'type',
        'amount',
        'concept',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function isIncome()
    {
        return $this->type === 'income';
    }

    public function isExpense()
    {
        return $this->type === 'expense';
    }
}
