<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccommodationRequest;
use App\Http\Requests\UpdateAccomodationRequest;
use App\Http\Resources\AccommodationResource;
use App\Models\Accommodation;
use App\Models\Contract;
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
    public function index()
    {
        $accommodations = Accommodation::query()->get();
        return AccommodationResource::collection($accommodations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return AccommodationResource
     */
    public function store(Request $request)
    {
        $created = Accommodation::query()->create([
            'title' => $request->title,
            'description' => $request->description,
            'standard_rack_rate' => $request->standard_rack_rate
        ]);
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
     * @return AccommodationResource | JsonResponse
     */
    public function update(Request $request, Accommodation $accommodation)
    {
        $updated = $accommodation->update([
            'title' => $request->title ?? $accommodation->title,
            'description' => $request->description ?? $accommodation->description,
            'standard_rack_rate' => $request->standard_rack_rate ?? $accommodation->standard_rack_rate
        ]);
        if(!$updated){
            return new JsonResponse([
                'errors' => [
                    'Failed to update model.'
                ]
            ], status: 400);
        }
        return new AccommodationResource($updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Accommodation $accommodation
     * @return JsonResponse
     */
    public function destroy(Accommodation $accommodation)
    {
        $deleted = $accommodation->forceDelete();
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
