<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Invoice;
use App\Models\Session;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoiceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStore()
    {
        // Create a admin, customer, user, and session
        $admin = Admin::factory()->create();
        $customer = Customer::factory()->create();
        $user = User::factory()->for($customer)->create();
        $session = Session::factory()->for($user)->create();

        // Define the data for the request
        $data = [
            'start_date' => now()->subMonth()->toDateString(),
            'end_date' => now()->toDateString(),
            'customer_id' => $customer->id,
        ];

        // Authenticate the admin
        $this->actingAs($admin);

        // Send a POST request to the store route
        $response = $this->postJson(route('invoices.store'), $data);

        // Assert the response status and structure
        $response->assertStatus(201);
        $response->assertJsonStructure(['invoice_id']);
    }

    public function testShow()
    {
        // Create a customer, user, session, and invoice
        $admin = Admin::factory()->create();
        $customer = Customer::factory()->create();
        $user = User::factory()->for($customer)->create();
        $session = Session::factory()->for($user)->create();
        $invoice = Invoice::factory()->for($customer)->create();

        // Authenticate the admin
        $this->actingAs($admin);

        // Send a GET request to the show route
        $response = $this->getJson(route('invoices.show', $invoice));

        // Assert the response status and structure
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'invoice_id',
            'customer_id',
            'start_date',
            'end_date',
            'total_amount',
            'details',
        ]);
    }
}
