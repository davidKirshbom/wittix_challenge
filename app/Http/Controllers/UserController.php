<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userService = new UserService();
        try {
            $user = $userService->create($request->all());
            return response()->json(['user' => $user]);
        } catch (\Exception $e) {
            return response($e->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = $request->user()->load(['customers']);
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Login the user.
     */
    public function login(Request $request)
    {
        $userService = new UserService();
        try {
            $user = $userService->login($request->all());
            return response()->json(['user' => $user]);
        } catch (\Exception $e) {
            return response($e->getMessage(), 401);
        }
    }
}
