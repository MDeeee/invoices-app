<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Interfaces\InvoiceRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function create(array $request): Invoice|JsonResponse
    {
        $start = $request['start_date'];
        $end = $request['end_date'];
        $customerId = $request['customer_id'];

        // Check if an invoice already exists for this period and customer
        $existingInvoice = Invoice::where('customer_id', $customerId)
        ->where('start_date', $start)
        ->where('end_date', $end)
        ->first();

        if ($existingInvoice) {
            throw new ConflictHttpException('An invoice for this period already exists');
        }

        $customer = Customer::find($customerId);
        $users = $customer->users()->whereBetween('registered_at', [$start, $end])->get();

        $total = 0;

        foreach ($users as $user) {

            $sessions = $user->sessions()
                ->whereBetween('activated', [$start, $end])
                ->orWhereBetween('appointment', [$start, $end])->get();

            $maxPrice = 0;

            foreach ($sessions as $session) {
                $price = 0;

                if ($session->activated) {
                    $price = 100;
                }
                if ($session->appointment) {
                    $price = 200;
                }

                $maxPrice = max($maxPrice, $price);
            }

            $total += $maxPrice;
        }

        $invoice = Invoice::create([
            'customer_id' => $customerId,
            'start_date' => $start,
            'end_date' => $end,
            'total_amount' => $total,
        ]);

        return $invoice;
    }

    public function find(int $id): JsonResponse
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], Response::HTTP_NOT_FOUND);
        }

        $users = $invoice->customer->users()->whereBetween('registered_at', [$invoice->start_date, $invoice->end_date])->get();

        $details = [];

        foreach ($users as $user) {

            $sessions = $user->sessions()
                ->whereBetween('activated', [$invoice->start_date, $invoice->end_date])
                ->orWhereBetween('appointment', [$invoice->start_date, $invoice->end_date])->get();

            $maxPrice = 0;

            foreach ($sessions as $session) {
                $price = 0;

                if ($session->activated) {
                    $price = 100;
                }
                if ($session->appointment) {
                    $price = 200;
                }

                $maxPrice = max($maxPrice, $price);
            }

            $details[] = [
                'user_id' => $user->id,
                'sessions' => $sessions,
                'total' => $maxPrice,
            ];
        }

        return response()->json([
            'invoice_id' => $invoice->id,
            'customer_id' => $invoice->customer_id,
            'start_date' => $invoice->start_date,
            'end_date' => $invoice->end_date,
            'total_amount' => $invoice->total_amount,
            'details' => $details,
        ], Response::HTTP_OK);
    }
}
