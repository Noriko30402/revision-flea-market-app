<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ConditionsTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conditions')->insert([
            ['condition_name' => '良好'],
            ['condition_name' => '目立った傷や汚れなし'],
            ['condition_name' => 'やや傷や汚れあり'],
            ['condition_name' => '状態が悪い'],
        ]);

    }
}
