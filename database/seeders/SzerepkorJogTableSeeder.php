<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SzerepkorJogTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('szerepkor_jog')->insert(array (
            0 =>
            array (
                'ID_jog' => 1,
                'ID_szerepkor' => 1,
            ),
            1 =>
            array (
                'ID_jog' => 2,
                'ID_szerepkor' => 1,
            ),
            2 =>
            array (
                'ID_jog' => 3,
                'ID_szerepkor' => 1,
            ),
        ));


    }
}
