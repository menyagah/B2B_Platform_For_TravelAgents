<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;
use App\Models\Booking;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $agent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgentRequest $request, Booking $agent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $agent)
    {
        //
    }
}
