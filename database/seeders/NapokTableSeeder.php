<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NapokTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('napok')->insert(array (
            0 =>
            array (
                'datum' => '2022-04-07',
                'ebed' => 0,
                'ID' => 5,
                'ID_tabor' => 1,
                'reggeli' => 0,
                'szallas' => 0,
                'tizorai' => 0,
                'uzsonna' => 0,
                'vacsora' => 0,
            ),
            1 =>
            array (
                'datum' => '2022-04-06',
                'ebed' => 0,
                'ID' => 6,
                'ID_tabor' => 1,
                'reggeli' => 0,
                'szallas' => 0,
                'tizorai' => 0,
                'uzsonna' => 0,
                'vacsora' => 0,
            ),
        ));


    }
}
