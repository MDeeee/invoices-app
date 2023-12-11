<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    protected static $userCount = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$userCount++;

        return [
            'name'  => 'user' . (self::$userCount) . '-' . self::$userCount,
            'email' => 'user' . (self::$userCount) . '-' . self::$userCount .'@example.com',
            'password' => Hash::make('12345678'),
            'registered_at' => now()->startOfMonth()->addDays(self::$userCount * 2)->format('Y-m-d')
        ];
    }
}
