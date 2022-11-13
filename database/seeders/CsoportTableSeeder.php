<?php

namespace Database\Seeders;


use App\Models\BaseModel;
use App\Models\Csoport;

class CsoportTableSeeder extends BaseSeeder
{
    protected function getModel(): BaseModel
    {
        return new Csoport();
    }

    protected function getValues(): array
    {
        return array(
            0 =>
                array(
                    'hely' => NULL,
                    'ID' => 1,
                    'ID_tabor' => 1,
                    'ID_vezeto1' => NULL,
                    'ID_vezeto2' => 4,
                    'nev' => 'Akármi csoport 123',
                ),
            1 =>
                array(
                    'hely' => 'asdasd',
                    'ID' => 5,
                    'ID_tabor' => 1,
                    'ID_vezeto1' => 2,
                    'ID_vezeto2' => NULL,
                    'nev' => 'csoport 3',
                ),
            2 =>
                array(
                    'hely' => NULL,
                    'ID' => 17,
                    'ID_tabor' => 1,
                    'ID_vezeto1' => NULL,
                    'ID_vezeto2' => NULL,
                    'nev' => '',
                ),
            3 =>
                array(
                    'hely' => NULL,
                    'ID' => 18,
                    'ID_tabor' => 1,
                    'ID_vezeto1' => 1,
                    'ID_vezeto2' => NULL,
                    'nev' => 'dfgsdgf',
                ),
            4 =>
                array(
                    'hely' => NULL,
                    'ID' => 21,
                    'ID_tabor' => 1,
                    'ID_vezeto1' => NULL,
                    'ID_vezeto2' => NULL,
                    'nev' => 'sadfsd',
                ),
        );
    }
}
