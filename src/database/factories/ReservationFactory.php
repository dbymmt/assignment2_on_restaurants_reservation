<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    
    // $users = User::all();
    // $restaurants = Restaurant::all();
    // 'user_id' => $users->random()->id;
    // 'restaurant_id => $restaurants->random()->id,


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $phone_no_before = $this->faker->phoneNumber();
        // 'scheduled_date => $this->faker->dateTimeBetween('now', '+1 year)', でなんとかならんかなw 
        return [
            //
            //'contact' => str_replace("-", "",$phone_no_before),
        ];
    }
}
