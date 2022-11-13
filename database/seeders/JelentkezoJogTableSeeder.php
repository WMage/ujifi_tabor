<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JelentkezoJogTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('jelentkezo_jog')->insert(array (
            0 =>
            array (
                'ID_jelentkezo' => 1,
                'ID_jog' => 4,
            ),
            1 =>
            array (
                'ID_jelentkezo' => 3,
                'ID_jog' => 2,
            ),
        ));


    }
}
