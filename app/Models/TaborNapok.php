<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Concerns\AsPivot;

/**
 * @property int $ID_tabor
 * @property int $ID_napok
 */
class TaborNapok extends BaseModel
{
    use AsPivot;
    protected $table = "tabor_napok";
}