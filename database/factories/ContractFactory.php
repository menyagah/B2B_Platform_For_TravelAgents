<?php

namespace Database\Factories;

use App\Models\Accommodation;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Database\Factories\Helpers;


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
        $accommodation_id = Helpers\FactoryHelper::getRandomModelId(Accommodation::class);
        $user_id = Helpers\FactoryHelper::getRandomModelId(User::class);
        return [
            'contract_rate'=> $this->faker->numberBetween(500, 1500),
            'start_date' => Carbon::instance($this->faker->dateTimeBetween('now')),
            'end_date' => Carbon::instance($this->faker->dateTimeBetween('now', '+1 year')),
            'accommodation_id'=> $accommodation_id,
            'user_id'=> $user_id,
        ];
    }
}
