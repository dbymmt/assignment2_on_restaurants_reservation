<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Restaurant;

class FavoriteFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_ids = User::all()->pluck('id');
        $restaurant_ids = Restaurant::all()->pluck('id');
        $matrix = $user_ids->crossJoin($restaurant_ids);
        $pairs = $this->faker->unique()->randomElement($matrix);
        return [
            //
            'user_id' => $pairs[0],
            'restaurant_id' => $pairs[1],
            // 'user_id' => $users->random()->id,
            // 'restaurant_id' => $restaurants->random()->id,
        ];
    }
}
