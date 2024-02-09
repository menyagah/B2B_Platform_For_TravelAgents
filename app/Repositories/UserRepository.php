<?php

namespace App\Repositories;

use App\Events\Models\Users\UserCreated;
use App\Events\Models\Users\UserDeleted;
use App\Events\Models\Users\UserUpdated;
use App\Exceptions\GeneralException;
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
            $created = User::query()->create([
                'name'=> data_get($attributes,'name',),
                'email' => data_get($attributes,'email',),
                'password'=> data_get($attributes,'password',),
            ]);
            throw_if(!$created, GeneralException::class, 'Failed to create model user.');
            event(new UserCreated($created));
            return $created;
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
            throw_if(!$updated, GeneralException::class, 'Failed to update user.');
            event(new UserUpdated($user));
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
            throw_if(!$deleted, GeneralException::class, 'Cannot delete user.');
            event(new UserDeleted($deleted));
            return $deleted;
        });
    }
}
