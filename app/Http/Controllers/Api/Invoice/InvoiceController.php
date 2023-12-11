<?php

namespace App\Http\Controllers\Api\Invoice;

use App\Models\Invoice;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Interfaces\InvoiceRepositoryInterface;

class InvoiceController extends Controller
{
    public function __construct(private InvoiceRepositoryInterface $invoiceRepository){}

    public function show(int $id) :JsonResponse
    {
        return $this->invoiceRepository->find($id);
    }

    public function store(StoreInvoiceRequest $request) :JsonResponse
    {
        $invoice = $this->invoiceRepository->create($request->validated());

        if ($invoice) return response()->json(['invoice_id' => $invoice->id], Response::HTTP_CREATED);

        return response()->json(['message' => 'Server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
