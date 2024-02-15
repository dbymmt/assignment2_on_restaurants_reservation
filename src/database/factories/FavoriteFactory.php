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
        $users = User::all();
        $restaurants = Restaurant::all();

        return [
            //
            'user_id' => $users->random()->id,
            'restaurant_id' => $restaurants->random()->id,
        ];
    }
}
