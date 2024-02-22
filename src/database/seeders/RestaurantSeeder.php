<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //元データ
        $tst_restaurants = [
            [
                'area_id' => 16,
                'genre_id' => 1,
                'name' => '仙人',
                'detail' => '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。',
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg'
            ],
            [
                'area_id' => 27,
                'genre_id' => 2,
                'name' => '牛助',
                'detail' => '焼肉業界で20年間経験を積み、肉を熟知したマスターによる実力派焼肉店。長年の実績とお付き合いをもとに、なかなか食べられない希少部位も仕入れております。また、ゆったりとくつろげる空間はお仕事終わりの一杯や女子会にぴったりです。',
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg'
            ],
        ];
        
        // 元データ入力
        foreach($tst_restaurants as $tst_restaurant)
        {
            $param = [
                'area_id' => $tst_restaurant['area_id'],
                'genre_id' => $tst_restaurant['genre_id'],
                'name' => $tst_restaurant['name'],
                'detail' => $tst_restaurant['detail'],
                'image_url' => $tst_restaurant['image_url'],
            ];
            DB::table('restaurants')->insert($param);
        }
        
        // ランダムデータ
        Restaurant::factory(18)->create();


    }
}
