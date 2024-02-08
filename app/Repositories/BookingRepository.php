<?php

namespace App\Repositories;

use App\Models\Contract;
use Illuminate\Support\Facades\DB;

class BookingRepository extends BaseRepository
{

    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes){
            return Contract::query()->create([
                'check_in_date'=> data_get($attributes,'check_in_date',),
                'check_out_date' => data_get($attributes,'check_out_date',),
                'accommodation_id'=> data_get($attributes,'accommodation_id',),
                'user_id'=> data_get($attributes,'user_id',),
                'contract_id' => data_get($attributes,'contract_id',),
                'contract_rate'=> data_get($attributes,'contract_rate',),
                'standard_rack_rate'=> data_get($attributes,'standard_rack_rate',),
            ]);
        });
    }

    public function update($model, array $attributes)
    {
        return DB::transaction(function () use ($model, $attributes){
            $updated = $model->update([
                'check_in_date' => data_get($attributes,'check_in_date', $model->check_in_date),
                'check_out_date' => data_get($attributes,'check_out_date', $model->check_out_date),
            ]);
            if(!$updated){
                throw new \Exception('Failed to update contract');
            }
            return $model;
        });
    }

    public function forceDelete($model)
    {
        return DB::transaction(function () use ($model){
            $deleted = $model->forceDelete();
            if(!$deleted){
                throw new \Exception('cannot delete post');
            }
            return $deleted;
        });
    }
}
