<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    protected $model = Admin::class;

    protected static $adminCount = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$adminCount++;

        return [
            'name'  => 'admin' . self::$adminCount,
            'email' => 'admin' . self::$adminCount .'@example.com',
            'password' => Hash::make('12345678'),
        ];
    }
}
