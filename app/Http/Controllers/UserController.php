<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Accommodation;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::query()->get();
        return new JsonResponse([
            'data'=> $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $created = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return new JsonResponse([
            'data' => $created
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
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
        return new JsonResponse([
            'data' => $updated
        ]);
    }

    /**
     * Remove the specified resource from storage.
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
