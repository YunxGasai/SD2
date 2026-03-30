<?php

namespace Database\Factories;

use App\Models\Conference;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConferenceFactory extends Factory
{
    protected $model = Conference::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'lecturers' => fake()->name(),
            'date' => fake()->date(),
            'time' => fake()->time('H:i'),
            'address' => fake()->streetAddress(),
        ];
    }
}
