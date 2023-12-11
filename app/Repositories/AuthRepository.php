<?php

namespace App\Repositories;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Validation\ValidationException;

class AuthRepository implements AuthRepositoryInterface
{
    public function user() :Authenticatable
    {
        return auth()->user();
    }

    public function login(array $request, string $model, string $role) :JsonResponse
    {
        $model = app($model);

        $account = $model->where('email', $request['email'])->first();

        if (!$account || !Hash::check($request['password'], $account->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'account' => $account,
            'token' => $account->createToken($account->email, ["role:$role"])->plainTextToken
        ]);
    }
}
