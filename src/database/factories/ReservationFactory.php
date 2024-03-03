<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Restaurant;

class ReservationFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $phone_no_before = $this->faker->phoneNumber();
        $users = User::all();
        $restaurants = Restaurant::all();
        $scheduled_date = $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d');
        $scheduled_time = $this->faker->numberBetween(0,23).':00';

        return [
            //
            'user_id' => $users->random()->id,
            'restaurant_id' => $restaurants->random()->id,
            'visitors' => random_int(1,10),
            // 'contact' => str_replace("-", "",$phone_no_before),
            'scheduled_date' => $scheduled_date,
            'scheduled_time' => $scheduled_time
        ];
    }
}
