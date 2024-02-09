<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class AccommodationRepository extends BaseRepository
{

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes){
            return Booking::query()->create([
                'title'=> data_get($attributes,'title',),
                'description' => data_get($attributes,'description',),
                'standard_rack_rate'=> data_get($attributes,'standard_rack_rate',),
            ]);
        });
    }

    /**
     * @param $accommodation
     * @param array $attributes
     * @return mixed
     */
    public function update($accommodation, array $attributes)
    {
        return DB::transaction(function () use ($accommodation, $attributes){
            $updated = $accommodation->update([
                'title' => data_get($attributes,'title', $accommodation->title),
                'description' => data_get($attributes,'description', $accommodation->description),
                'standard_rack_rate' => data_get($attributes,'standard_rack_rate', $accommodation->standard_rack_rate),
            ]);
            if(!$updated){
                throw new \Exception('Failed to update contract');
            }
            return $accommodation;
        });
    }

    /**
     * @param $accommodation
     * @return mixed
     */
    public function forceDelete($accommodation)
    {
        return DB::transaction(function () use ($accommodation){
            $deleted = $accommodation->forceDelete();
            if(!$deleted){
                throw new \Exception('cannot delete post');
            }
            return $deleted;
        });
    }
}
