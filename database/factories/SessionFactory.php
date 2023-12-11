<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    protected $model = Session::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hasAppointment = rand(0,1) == 1;

        return [
            'user_id'     => User::factory(),
            'activated'   => !$hasAppointment ? $this->faker->dateTimeThisMonth : null,
            'appointment' => $hasAppointment ? $this->faker->dateTimeThisMonth : null,
        ];
    }
}
