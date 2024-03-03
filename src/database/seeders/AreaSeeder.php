<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tst_areas = [
            '北海道', '青森', '秋田', '岩手', '山形', '宮城', '福島', '新潟', '富山', '石川',
            '福井', '群馬', '栃木', '茨城', '埼玉', '東京', '千葉', '神奈川', '山梨', '長野',
            '静岡', '愛知', '岐阜', '三重', '滋賀', '京都', '大阪', '和歌山', '兵庫', '奈良',
            '鳥取', '島根', '岡山', '広島', '山口', '香川', '愛媛', '高知', '徳島', '福岡',
            '佐賀', '長崎', '熊本', '大分', '宮崎', '鹿児島', '沖縄',
        ];

        foreach($tst_areas as $tst_area)
        {
            $param = [
                'name' => $tst_area,
            ];
            DB::table('areas')->insert($param);
        };
        
        // $param = [
        //     'content' => '商品のお届けについて'
        // ];
        // DB::table('categories')->insert($param);
    }
}
