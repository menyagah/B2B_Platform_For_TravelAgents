<?php

namespace Database\Factories;

use App\Models\Accommodation;
use App\Models\Contract;
use App\Models\User;
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
        $accommodation_id = Helpers\FactoryHelper::getRandomModelId(Accommodation::class);
        $user_id = Helpers\FactoryHelper::getRandomModelId(User::class);
        $contract_id = Helpers\FactoryHelper::getRandomModelId(Contract::class);
        return [
            'check_in_date' => Carbon::instance($this->faker->dateTimeBetween('now')),
            'check_out_date' => Carbon::instance($this->faker->dateTimeBetween('now', '+1 year')),
            'accommodation_id'=> $accommodation_id,
            'user_id'=> $user_id,
            'contract_id'=>$contract_id,
            'contract_rate' => 100.00,
        ];
    }
}
