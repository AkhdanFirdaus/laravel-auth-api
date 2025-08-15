<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(UserResource::collection(User::paginate()->get()), 200);
    }

    public function show(User $user)
    {
        return response()->json(new UserResource($user), 200);
    }

    public function update() {}
}
