<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\RegisterUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $authors = User::with(['posts', 'comments'])->take(10)->get();

        return Response::json($authors);
    }

    public function store(StoreUserRequest $request, RegisterUser $registerUser): JsonResponse
    {
        $userData = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        return Response::json($registerUser->__invoke($userData));
    }
}
