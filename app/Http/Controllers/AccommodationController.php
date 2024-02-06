<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccomodationRequest;
use App\Http\Requests\UpdateAccomodationRequest;
use App\Models\Accommodation;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => 'accommodations'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccomodationRequest $request)
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => 'posted'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Accommodation $accommodation)
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => $accommodation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccomodationRequest $request, Accommodation $accommodation)
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => 'updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accommodation $accommodation)
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => 'deleted'
        ]);
    }
}
