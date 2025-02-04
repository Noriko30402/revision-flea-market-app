<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['id' => 1, 'content' => 'ファッション'],
            ['id' => 2, 'content' => '家電'],
            ['id' => 3, 'content' => 'インテリア'],
            ['id' => 4, 'content' => 'レディース'],
            ['id' => 5, 'content' => 'メンズ'],
            ['id' => 6, 'content' => 'コスメ'],
            ['id' => 7, 'content' => '本'],
            ['id' => 8, 'content' => 'ゲーム'],
            ['id' => 9, 'content' => 'スポーツ'],
            ['id' => 10, 'content' => 'キッチン'],
            ['id' => 11, 'content' => 'ハンドメイド'],
            ['id' => 12, 'content' => 'アクセサリー'],
            ['id' => 13, 'content' => 'おもちゃ'],
            ['id' => 14, 'content' => 'ベビー・キッズ'],
        ]);

    }
}
