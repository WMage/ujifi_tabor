<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(array (
            0 =>
            array (
                'access_level' => 2,
                'api_token' => 'asdasdasd',
                'created_at' => '2022-04-06 14:31:01',
                'email' => 'bsebi88@gmail.com',
                'email_verified_at' => '2022-04-14 14:30:48',
                'id' => 1,
                'name' => 'WMage',
                'password' => '$2y$10$EXXObg.eeax8X4IHlwKHd.TBRCfkObvL6PL/HkSGVaAC9wHlyCo72',
                'remember_token' => 'QqUNpjJxEVz8B5EZX022zaZS9JdSp9l49xyNEbHjnOz93EMXwIw6HJlcwRat',
                'updated_at' => NULL,
            ),
        ));


    }
}
