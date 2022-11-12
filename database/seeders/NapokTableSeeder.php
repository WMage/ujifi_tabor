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
                'ebed_kerheto' => 0,
                'ID' => 5,
                'ID_tabor' => 1,
                'reggeli_kerheto' => 0,
                'szallas_kerheto' => 0,
                'tizorai_kerheto' => 0,
                'uzsonna_kerheto' => 0,
                'vacsora_kerheto' => 0,
            ),
            1 =>
            array (
                'datum' => '2022-04-06',
                'ebed_kerheto' => 0,
                'ID' => 6,
                'ID_tabor' => 1,
                'reggeli_kerheto' => 0,
                'szallas_kerheto' => 0,
                'tizorai_kerheto' => 0,
                'uzsonna_kerheto' => 0,
                'vacsora_kerheto' => 0,
            ),
        ));


    }
}
