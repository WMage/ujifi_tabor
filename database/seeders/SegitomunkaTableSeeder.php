<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SegitomunkaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('segitomunka')->insert(array (
            0 =>
            array (
                'alias' => 'csoport_vezeto',
                'ID' => 1,
                'megnevezes' => 'Csoport Vezető',
            ),
            1 =>
            array (
                'alias' => 'valami',
                'ID' => 2,
                'megnevezes' => 'akármi',
            ),
        ));


    }
}
