<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JelentkezoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('jelentkezo')->insert(array (
            0 =>
            array (
                'DATE_creation' => '2022-04-20 23:28:31',
                'DATE_lastmod' => '2022-04-27 01:19:38',
                'eloleg' => 0,
                'eloleg_megerkezett' => NULL,
                'email' => 'asd@dsa',
                'ID' => 1,
                'ID_aszf' => NULL,
                'ID_csoport' => NULL,
                'ID_szallasszoba' => NULL,
                'ID_szerepkor' => 1,
                'ID_tabor' => 1,
                'ID_user' => 1,
                'MOD_user' => NULL,
                'nem' => NULL,
                'nev_elotag' => NULL,
                'nev_kereszt' => 'asd',
                'nev_vezetek' => 'wm',
                'nevnap' => NULL,
                'szallas_kulcsszo' => NULL,
                'szuletesnap' => NULL,
                'taborba_megerkezett' => NULL,
            ),
            1 =>
            array (
                'DATE_creation' => '2022-04-22 13:24:32',
                'DATE_lastmod' => '2022-04-22 21:38:12',
                'eloleg' => 0,
                'eloleg_megerkezett' => NULL,
                'email' => NULL,
                'ID' => 2,
                'ID_aszf' => NULL,
                'ID_csoport' => NULL,
                'ID_szallasszoba' => NULL,
                'ID_szerepkor' => NULL,
                'ID_tabor' => 1,
                'ID_user' => NULL,
                'MOD_user' => NULL,
                'nem' => NULL,
                'nev_elotag' => 'munkavegzo',
                'nev_kereszt' => '',
                'nev_vezetek' => '',
                'nevnap' => NULL,
                'szallas_kulcsszo' => NULL,
                'szuletesnap' => NULL,
                'taborba_megerkezett' => NULL,
            ),
            2 =>
            array (
                'DATE_creation' => '2022-04-22 12:07:54',
                'DATE_lastmod' => '2022-04-29 23:41:15',
                'eloleg' => 0,
                'eloleg_megerkezett' => NULL,
                'email' => NULL,
                'ID' => 3,
                'ID_aszf' => NULL,
                'ID_csoport' => NULL,
                'ID_szallasszoba' => NULL,
                'ID_szerepkor' => NULL,
                'ID_tabor' => 1,
                'ID_user' => 1,
                'MOD_user' => NULL,
                'nem' => NULL,
                'nev_elotag' => 'dsa',
                'nev_kereszt' => '',
                'nev_vezetek' => 'dsads',
                'nevnap' => NULL,
                'szallas_kulcsszo' => NULL,
                'szuletesnap' => NULL,
                'taborba_megerkezett' => NULL,
            ),
            3 =>
            array (
                'DATE_creation' => '2022-04-29 23:06:19',
                'DATE_lastmod' => '2022-04-29 23:14:54',
                'eloleg' => 0,
                'eloleg_megerkezett' => NULL,
                'email' => NULL,
                'ID' => 4,
                'ID_aszf' => NULL,
                'ID_csoport' => NULL,
                'ID_szallasszoba' => NULL,
                'ID_szerepkor' => NULL,
                'ID_tabor' => 1,
                'ID_user' => NULL,
                'MOD_user' => NULL,
                'nem' => NULL,
                'nev_elotag' => 'sdfsfd',
                'nev_kereszt' => '',
                'nev_vezetek' => '',
                'nevnap' => NULL,
                'szallas_kulcsszo' => NULL,
                'szuletesnap' => NULL,
                'taborba_megerkezett' => NULL,
            ),
        ));


    }
}
