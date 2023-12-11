<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Http\Resources\Account;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Interfaces\AuthRepositoryInterface;

class UserAuthController extends Controller
{
    public function __construct(private AuthRepositoryInterface $authRepository){}

    public function user() :Account
    {
        return Account::make($this->authRepository->user());
    }

    public function login(AuthLoginRequest $request) :JsonResponse
    {
        return $this->authRepository->login($request->validated(), User::class, 'user');
    }
}
