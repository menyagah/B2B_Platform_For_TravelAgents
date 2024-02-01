<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contract_rate'=> $this->faker->numberBetween(500, 1500),
            'start_date' => Carbon::instance($this->faker->dateTimeBetween('now')),
            'end_date' => Carbon::instance($this->faker->dateTimeBetween('now', '+1 year')),
            'accommodation_id'=> 1,
            'user_id'=> 1
        ];
    }
}
