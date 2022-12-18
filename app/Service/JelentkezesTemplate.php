<?php

namespace App\Service;

use Illuminate\Support\Collection;

/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2018.08.16.
 * Time: 17:19
 */
class JelentkezesTemplate extends Template
{
    public static function generateEtkezesCheckbox(array $list, array $selected = []): string
    {
        return self::generateMultiCheckbox(
            'tabor_etkezes_lista',
            $list,
            $selected,
            [
                'ID' => 'ID',
                'ROW' => 'datum',
                'VALUES' => [
                    'reggeli_kerheto' => 'Reggeli',
                    'tizorai_kerheto' => 'Tízórai',
                    'ebed_kerheto' => 'Ebéd',
                    'uzsonna_kerheto' => 'Uzsonna',
                    'vacsora_kerheto' => 'Vacsora',
                ]
            ]
        );
    }
}
