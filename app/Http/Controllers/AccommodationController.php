<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccommodationRequest;
use App\Http\Requests\UpdateAccomodationRequest;
use App\Http\Resources\AccommodationResource;
use App\Http\Resources\BookingResource;
use App\Models\Accommodation;
use App\Models\Contract;
use App\Repositories\AccommodationRepository;
use App\Repositories\BookingRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(Request $request)
    {
        $pageSize = $request->page_size ?? 20;
        $accommodations = Accommodation::query()->paginate($pageSize);
        return AccommodationResource::collection($accommodations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param BookingRepository $repository
     * @return AccommodationResource
     */
    public function store(Request $request, BookingRepository $repository)
    {
        $created = $repository->create($request->only([
            'title' ,
            'description',
            'standard_rack_rate'
        ]));
        return new AccommodationResource($created);
    }

    /**
     * Display the specified resource.
     *
     * @param Accommodation $accommodation
     * @return AccommodationResource
     */
    public function show(Accommodation $accommodation)
    {
        return new AccommodationResource($accommodation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Accommodation $accommodation
     * @param AccommodationRepository $repository
     * @return AccommodationResource | JsonResponse
     */
    public function update(Request $request, Accommodation $accommodation, AccommodationRepository $repository)
    {
        $updated = $repository->update($accommodation, $request->only([
            'title',
            'description',
            'standard_rack_rate'
        ]));

        return new AccommodationResource($updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Accommodation $accommodation
     * @param AccommodationRepository $repository
     * @return JsonResponse
     */
    public function destroy(Accommodation $accommodation, AccommodationRepository $repository)
    {
        $repository->forceDelete($accommodation);
        return new JsonResponse([
            'data' => 'successfully deleted'
        ]);
    }
}
