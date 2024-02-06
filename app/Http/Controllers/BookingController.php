<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => 'bookings'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        return new \Illuminate\Http\JsonResponse([
        'data' => 'posted'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => $booking
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => 'updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => 'deleted'
        ]);
    }
}
