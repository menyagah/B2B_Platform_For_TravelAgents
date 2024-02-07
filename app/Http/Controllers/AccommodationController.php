<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccommodationRequest;
use App\Http\Requests\UpdateAccomodationRequest;
use App\Models\Accommodation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $accommodations = Accommodation::query()->get();
        return new JsonResponse([
            'data'=> $accommodations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @return JsonResponse
     */
    public function store(StoreAccommodationRequest $request)
    {
        $created = Accommodation::query()->create([
            'title' => $request->title,
            'description' => $request->description,
            'standard_rack_rate' => $request->standard_rack_rate
        ]);
        return new JsonResponse([
            'data' => $created
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show(Accommodation $accommodation)
    {
        return new JsonResponse([
            'data' => $accommodation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return JsonResponse
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
        return new JsonResponse([
            'data' => $updated
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
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
