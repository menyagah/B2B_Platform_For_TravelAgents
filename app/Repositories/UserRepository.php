<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes){
            return User::query()->create([
                'name'=> data_get($attributes,'name',),
                'email' => data_get($attributes,'email',),
                'password'=> data_get($attributes,'password',),
            ]);
        });
    }

    /**
     * @param $user
     * @param array $attributes
     * @return mixed
     */
    public function update($user, array $attributes)
    {
        return DB::transaction(function () use ($user, $attributes){
            $updated = $user->update([
                'name' => data_get($attributes,'name', $user->name),
                'email' => data_get($attributes,'email', $user->email),
            ]);
            if(!$updated){
                throw new \Exception('Failed to update contract');
            }
            return $user;
        });
    }

    /**
     * @param $user
     * @return mixed
     */
    public function forceDelete($user)
    {
        return DB::transaction(function () use ($user){
            $deleted = $user->forceDelete();
            if(!$deleted){
                throw new \Exception('cannot delete post');
            }
            return $deleted;
        });
    }
}
