<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JogTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('jog')->insert(array (
            0 =>
            array (
                'alias' => 'groups',
                'ID' => 1,
                'nev' => 'asd1',
            ),
            1 =>
            array (
                'alias' => 'b',
                'ID' => 2,
                'nev' => 'asd2',
            ),
            2 =>
            array (
                'alias' => 'c',
                'ID' => 3,
                'nev' => 'asd3',
            ),
            3 =>
            array (
                'alias' => 'd',
                'ID' => 4,
                'nev' => 'dsa',
            ),
        ));


    }
}
