<?php

namespace App\Models;

use Illuminate\Support\Carbon;

/**
 * @property int $ID
 * @property Carbon|string $datum
 * @property bool $reggeli_kerheto
 * @property bool $tizorai_kerheto
 * @property bool $ebed_kerheto
 * @property bool $uzsonna_kerheto
 * @property bool $vacsora_kerheto
 * @property bool $szallas_kerheto
 * @property int $ID_tabor
 */
class Napok extends BaseModel
{
    protected $table = "napok";
}