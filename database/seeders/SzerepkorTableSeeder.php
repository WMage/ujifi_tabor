<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SzerepkorTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('szerepkor')->insert(array (
            0 =>
            array (
                'ID' => 1,
                'nev' => 'asd',
                'leiras' => 'asd',
            ),
        ));


    }
}
