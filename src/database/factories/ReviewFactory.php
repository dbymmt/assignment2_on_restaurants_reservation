<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Restaurant;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all();
        $restaurants = Restaurant::all();
        $visited_date = $this->faker->dateTimeBetween('-1year', 'now')->format('Y-m-d');
        return [
            //
            'user_id' => $users->random()->id,
            'restaurant_id' => $restaurants->random()->id,
            'score' => random_int(1, 5),
            'visited_date' => $visited_date,
            'comment' => $this->faker->realText(rand(100, 200))
        ];
    }
}
