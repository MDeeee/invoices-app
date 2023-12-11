<?php
namespace App\Interfaces;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Auth\Authenticatable;

interface AuthRepositoryInterface
{
    public function user(): Authenticatable;
    public function login(array $data, string $model, string $role): JsonResponse;
}
