<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Accommodation;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index()
    {
        $users = User::query()->get();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return UserResource
     */
    public function store(Request $request)
    {
        $created = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return new UserResource($created);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return UserResource | JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $updated = $user->update([
            'name' => $request->name ?? $user->name,
        ]);
        if(!$updated){
            return new JsonResponse([
                'errors' => [
                    'Failed to update model.'
                ]
            ], status: 400);
        }
        return new UserResource($updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $deleted = $user->forceDelete();
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
