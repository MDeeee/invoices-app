<?php
namespace App\Interfaces;

use App\Models\Invoice;
use Illuminate\Http\JsonResponse;

interface InvoiceRepositoryInterface
{
    public function create(array $data): Invoice|JsonResponse;
    public function find(int $id): JsonResponse;
}
