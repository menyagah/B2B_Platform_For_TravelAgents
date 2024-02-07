<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Accommodation;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings= Booking::query()->get();
        return new JsonResponse([
            'data'=> $bookings
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $created = Booking::query()->create([
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'accommodation_id'=> $request->accommodation_id,
            'user_id'=> $request->user_id,
            'contract_id'=>$request->contract_id,
            'contract_rate' => $request->contract_rate,
            'standard_rack_rate'=> $request->standard_rack_rate
        ]);
        return new JsonResponse([
            'data' => $created
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
        $updated = $booking->update([
            'check_in_date' => $request->check_in_date ?? $booking->check_in_date,
            'check_out_date' => $request->check_out_date ?? $booking->check_out_date,
        ]);
        if(!$updated){
            return new JsonResponse([
                'errors' => [
                    'Failed to update model.'
                ]
            ], status: 400);
        }
        return new JsonResponse([
            'data' => $updated
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $deleted = $booking->forceDelete();
        if(!$deleted){
            return new JsonResponse([
                'errors' => 'Could not delete resource'
            ], 400);
        }
        return new JsonResponse([
            'data' => 'successfully deleted'
        ]);
    }
}
