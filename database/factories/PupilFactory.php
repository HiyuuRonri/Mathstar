<?php

namespace Database\Factories;

use App\Models\Pupil;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PupilFactory extends Factory
{
    protected $model = Pupil::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'username' => $this->faker->unique()->userName,
            'classroom_code' => $this->faker->regexify('[A-Z0-9]{8}'), // Example classroom code
            'password' => bcrypt('password'), // Default password
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
