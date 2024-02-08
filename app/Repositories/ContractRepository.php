<?php

namespace App\Repositories;

use App\Http\Resources\ContractResource;
use App\Models\Contract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes){
            $created = Contract::query()->create([
                'contract_rate'=> data_get($attributes,'contract_rate',),
                'start_date' => data_get($attributes,'start_date',),
                'end_date' => data_get($attributes,'end_date',),
                'accommodation_id'=> data_get($attributes,'accommodation_id',),
                'user_id'=> data_get($attributes,'user_id',)
            ]);


            return $created;
        });
    }

    public function update(Contract $contract, array $attributes)
    {
        return DB::transaction(function () use ($contract, $attributes){
            $updated = $contract->update([
                'contract_rate'=> data_get($attributes,'contract_rate', $contract->contract_rate),
                'start_date' => data_get($attributes,'start_date', $contract->start_date),
                'end_date' => data_get($attributes,'end_date', $contract->end_date),
            ]);
            if(!$updated){
                throw new \Exception('Failed to update contract');
            }
            return $contract;
        });
    }

    public function forceDelete(Contract $contract)
    {
        return DB::transaction(function () use ($contract){
            $deleted = $contract->forceDelete();
            if(!$deleted){
                throw new \Exception('cannot delete post');
            }
            return $deleted;
        });
    }


}
