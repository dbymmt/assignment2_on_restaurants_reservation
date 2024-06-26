<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(OwnerSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(RestaurantSeeder::class);
        $this->call(FavoriteSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(ReviewSeeder::class);
    }
}
