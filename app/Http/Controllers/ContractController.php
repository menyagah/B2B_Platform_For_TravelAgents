<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Http\Resources\ContractResource;
use App\Models\Accommodation;
use App\Models\Contract;
use App\Repositories\ContractRepository;
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
        $pageSize = $request->page_size ?? 20;
        $contracts = Contract::query()->paginate($pageSize);
        return ContractResource::collection($contracts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ContractResource
     */
    public function store(Request $request, ContractRepository $repository)
    {
        $created = $repository->create($request->only([
            'contract_rate',
            'start_date',
            'end_date',
            'accommodation_id',
            'user_id'
        ]));
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
     * @param Request $request
     * @param Contract $contract
     * @return ContractResource
     */
    public function update(Request $request, Contract $contract, ContractRepository $repository)
    {
        $contract = $repository->update($contract, $request->only([
            'contract_rate',
            'start_date',
            'end_date'
        ]));
        return new ContractResource($contract);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Contract $contract, ContractRepository $repository)
    {
        $repository->forceDelete($contract);
        return new JsonResponse([
            'data' => 'successfully deleted'
        ]);
    }
}
