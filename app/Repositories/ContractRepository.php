<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;

class ContractRepository extends BaseRepository
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
//            if(!$created){
//                throw new GeneralException('Failed to create Post.');
//            }
            throw_if(!$created, GeneralException::class, 'Opps! something went wrong.Failed to create Contract.');

            return $created;
        });
    }

    public function update($contract, array $attributes)
    {
        return DB::transaction(function () use ($contract, $attributes){
            $updated = $contract->update([
                'contract_rate'=> data_get($attributes,'contract_rate', $contract->contract_rate),
                'start_date' => data_get($attributes,'start_date', $contract->start_date),
                'end_date' => data_get($attributes,'end_date', $contract->end_date),
            ]);
            throw_if(!$updated, GeneralException::class, 'Something went wrong.Failed to update contract.');
            return $contract;
        });
    }

    public function forceDelete($contract)
    {
        return DB::transaction(function () use ($contract){
            $deleted = $contract->forceDelete();
            throw_if(!$deleted, GeneralException::class, 'Failed to delete the contract');
            return $deleted;
        });
    }


}
