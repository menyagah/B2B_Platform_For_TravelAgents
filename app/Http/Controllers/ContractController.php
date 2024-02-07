<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Http\Resources\ContractResource;
use App\Models\Accommodation;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(Request $request)
    {
        $contracts = Contract::query()->get();
        return ContractResource::collection($contracts);

//        $userId = $request->user()->id;
//        $contracts = Contract::where('user_id', $userId)->get();
//        return response()->json($contracts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return ContractResource
     */
    public function store(Request $request)
    {
        $created = DB::transaction(function () use ($request){
            $created = Contract::query()->create([
                'contract_rate'=> $request->contract_rate,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'accommodation_id'=> $request->accommodation_id,
                'user_id'=> $request->user_id,
            ]);

            return $created;
        });

        return new ContractResource($created);
    }

    /**
     * Display the specified resource.
     *
     * @param Contract $contract
     * @return ContractResource
     */
    public function show(Contract $contract)
    {
        return new ContractResource($contract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Contract $contract
     * @return ContractResource | JsonResponse
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
                'errors' =>
                    'Failed to update model.'
            ], status: 400);
        }
        return new ContractResource($contract);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contract $contract
     * @return \Illuminate\Http\JsonResponse
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
