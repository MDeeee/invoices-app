<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Customer;
use App\Http\Resources\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Interfaces\AuthRepositoryInterface;

class CustomerAuthController extends Controller
{
    public function __construct(private AuthRepositoryInterface $authRepository){}

    public function user()
    {
        return Account::make($this->authRepository->user());
    }

    public function login(AuthLoginRequest $request)
    {
        return $this->authRepository->login($request->validated(), Customer::class, 'customer');
    }
}
