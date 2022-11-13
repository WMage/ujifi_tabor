<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JelentkezoSegitomunkaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('jelentkezo_segitomunka')->insert(array (
            0 =>
            array (
                'ID_jelentkezo' => 2,
                'ID_segito_munka' => 1,
            ),
            1 =>
            array (
                'ID_jelentkezo' => 2,
                'ID_segito_munka' => 2,
            ),
        ));


    }
}
