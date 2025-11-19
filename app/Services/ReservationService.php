<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Exception;

class ReservationService
{
    /**
     * Create a new reservation ensuring no overlap.
     *
     * @param array $data
     * @return Reservation
     * @throws Exception
     */
    public function createReservation(array $data): Reservation
    {
        // Check for overlaps
        $hasOverlap = Reservation::where('property_id', $data['property_id'])
            ->where(function ($query) use ($data) {
                $query->whereBetween('start_date', [$data['start_date'], $data['end_date']])
                    ->orWhereBetween('end_date', [$data['start_date'], $data['end_date']])
                    ->orWhere(function ($query) use ($data) {
                        $query->where('start_date', '<=', $data['start_date'])
                            ->where('end_date', '>=', $data['end_date']);
                    });
            })
            ->exists();

        if ($hasOverlap) {
            throw new Exception('La propiedad ya está reservada en las fechas seleccionadas.');
        }

        return DB::transaction(function () use ($data) {
            return Reservation::create($data);
        });
    }
}
