<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Resources\BookingResource;
use App\Http\Resources\ContractResource;
use App\Models\Accommodation;
use App\Models\Booking;
use App\Models\Contract;
use App\Repositories\BookingRepository;
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
     * @param BookingRepository $repository
     * @return BookingResource
     */
    public function store(Request $request, BookingRepository $repository)
    {
        $created = $repository->create($request->only([
            'check_in_date',
            'check_out_date',
            'accommodation_id',
            'user_id',
            'contract_id',
            'contract_rate',
            'standard_rack_rate'
        ]));

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
     * @param BookingRepository $repository
     * @return BookingResource
     */
    public function update(Request $request, Booking $booking, BookingRepository $repository)
    {
        $updated = $repository->update($booking, $request->only([
            'check_in_date',
            'check_out_date'
        ]));

        return new BookingResource($updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Booking $booking
     * @param BookingRepository $repository
     * @return JsonResponse
     */
    public function destroy(Booking $booking, BookingRepository $repository)
    {
        $deleted = $repository->forceDelete($booking);
        return new JsonResponse([
            'data' => 'successfully deleted'
        ]);
    }
}
