<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{

    protected $model = Customer::class;

    protected static $customerCount = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$customerCount++;

        return [
            'name'  => 'customer' . self::$customerCount,
            'email' => 'customer' . self::$customerCount .'@example.com',
            'password' => Hash::make('12345678'),
        ];
    }
}
