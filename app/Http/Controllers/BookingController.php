<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Accommodation;
use App\Models\Booking;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(Request $request)
    {
        $pageSize = $request->page_size ?? 20;
        $bookings= Booking::query()->paginate($pageSize);
        return BookingResource::collection($bookings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return BookingResource
     */
    public function store(Request $request)
    {
        $created = DB::transaction(function () use ($request){
            $created = Booking::query()->create([
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,
                'accommodation_id'=> $request->accommodation_id,
                'user_id'=> $request->user_id,
                'contract_id'=>$request->contract_id,
                'contract_rate' => $request->contract_rate,
                'standard_rack_rate'=> $request->standard_rack_rate
            ]);
            return $created;
        });

        return new BookingResource($created);
    }

    /**
     * Display the specified resource.
     *
     * @param Booking $booking
     * @return BookingResource
     */
    public function show(Booking $booking)
    {
        return new BookingResource($booking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Booking $booking
     * @return BookingResource | JsonResponse
     */
    public function update(Request $request, Booking $booking)
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
        return new BookingResource($updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Booking $booking
     * @return JsonResponse
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
