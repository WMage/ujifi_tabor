<?php

namespace Database\Seeders;

use App\Models\BaseModel;
use App\Models\Tabor;

class TaborTableSeeder extends BaseSeeder
{

    protected function getModel(): BaseModel
    {
        return new Tabor();
    }

    protected function getValues(): array
    {
        return array(
            0 =>
                array(
                    'cim' => NULL,
                    'nev' => 'tabor 1',
                    'DATE_creation' => '2022-04-20 23:30:31',
                    'DATE_lastmod' => '2022-04-24 18:44:20',
                    'ferohely' => NULL,
                    'ID' => 1,
                    'ID_aszf' => NULL,
                    'kor_max' => NULL,
                    'kor_min' => NULL,
                    'motto' => 'asdasd',
                    'REG_end' => NULL,
                    'REG_start' => NULL,
                    'varos' => NULL,
                ),
            1 =>
                array(
                    'cim' => NULL,
                    'nev' => 'tabor 2',
                    'DATE_creation' => '2022-04-24 18:56:54',
                    'DATE_lastmod' => NULL,
                    'ferohely' => NULL,
                    'ID' => 2,
                    'ID_aszf' => NULL,
                    'kor_max' => NULL,
                    'kor_min' => NULL,
                    'motto' => 'dsasda',
                    'REG_end' => NULL,
                    'REG_start' => NULL,
                    'varos' => NULL,
                ),
        );
    }
}
