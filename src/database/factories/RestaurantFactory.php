<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Area;
uSE App\Models\Genre;

class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $areas = Area::all();
        $genres = Genre::all();
        $images = [
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg',
        ];

        return [
            //
            'area_id' => $areas->random()->id,
            'genre_id' => $genres->random()->id,
            'name' => $this->faker->name(),
            'detail' => $this->faker->realText(rand(100,200)),
            'image_url' => $images[rand(0,4)],
        ];
    }
}
