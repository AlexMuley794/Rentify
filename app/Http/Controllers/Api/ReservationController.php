<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function index()
    {
        $reservations = Reservation::with('property')->paginate(10);
        return ReservationResource::collection($reservations);
    }

    public function store(StoreReservationRequest $request)
    {
        try {
            $reservation = $this->reservationService->createReservation($request->validated());
            return new ReservationResource($reservation);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function show(Reservation $reservation)
    {
        $this->authorize('view', $reservation);
        return new ReservationResource($reservation);
    }
}
