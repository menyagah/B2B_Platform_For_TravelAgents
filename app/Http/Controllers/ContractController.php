<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Accommodation;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::query()->get();
        return new JsonResponse([
            'data'=> $contracts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request)
    {
        $created = Accommodation::query()->create([
            'contract_rate'=> $request->contract_rate,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'accommodation_id'=> $request->accommodation_id,
            'user_id'=> $request->user_id,
        ]);
        return new JsonResponse([
            'data' => $created
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => $contract
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $updated = $contract->update([
            'contract_rate'=> $request->contract_rate ?? $contract->contract_rate,
            'start_date' => $request->start_date ?? $contract->start_date,
            'end_date' => $request->end_date ?? $contract->end_date,
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
    public function destroy(Contract $contract)
    {
        $deleted = $contract->forceDelete();
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
