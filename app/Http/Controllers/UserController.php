<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => 'user'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => 'posted'
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
    public function update(UpdateUserRequest $request, User $user)
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => 'patched'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return new \Illuminate\Http\JsonResponse([
            'data' => 'deleted'
        ]);
    }
}
