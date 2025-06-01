<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class UsersTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'ユーザー１',
            'email' => 'user-one@test.com',
            'password' =>bcrypt('password'),
            ];
        DB::table('users')->insert($param);

            $param = [
            'name' => 'ユーザー2',
            'email' => 'user-two@test.com',
            'password' => bcrypt('password'),
            ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'ユーザー3',
            'email' => 'user-three@test.com',
            'password' => bcrypt('password'),
            ];
        DB::table('users')->insert($param);

    }
}
