<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tst_genres = ['寿司', '焼き肉', '居酒屋', 'イタリアン', 'ラーメン'];
        
        foreach($tst_genres as $tst_genre)
        {
            $param = [
                'name' => $tst_genre,
            ];
            DB::table('genres')->insert($param);
        };
        // $param = [
        //     'content' => '商品のお届けについて'
        // ];
        // DB::table('categories')->insert($param);
    }
}
