<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'check_in_date' => Carbon::instance($this->faker->dateTimeBetween('now')),
            'check_out_date' => Carbon::instance($this->faker->dateTimeBetween('now', '+1 year')),
            'accommodation_id'=> 1,
            'user_id'=> 3
        ];
    }
}
