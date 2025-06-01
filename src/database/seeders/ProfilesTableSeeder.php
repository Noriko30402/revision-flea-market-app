<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            [
                'name' => 'ユーザー１',
                'postcode' => 1111111,
                'address' => '大阪市代々木町',
                'building' => 'クレストコート 1111',
                'user_id' => 1,
            ],

            [
                'name' => 'ユーザー2',
                'postcode' => 2222222,
                'address' => '大阪市松山町',
                'building' => 'クレストコート 2222',
                'user_id' => 2,
            ],


            [
                'name' => 'ユーザー',
                'postcode' => 3333333,
                'address' => '大阪市塚崎市',
                'building' => 'クレストコート 3333',
                'user_id' => 3,
            ],
        ]);

}
}