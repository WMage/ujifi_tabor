<?php

namespace App\Models;

use Illuminate\Support\Carbon;

/**
 * @property int $ID
 * @property Carbon|string $datum
 * @property bool $reggeli
 * @property bool $tizorai
 * @property bool $ebed
 * @property bool $uzsonna
 * @property bool $vacsora
 * @property bool $jelenlet
 * @property bool $szallas
 */
class Napok extends BaseModel
{
    protected $table = "napok";
}