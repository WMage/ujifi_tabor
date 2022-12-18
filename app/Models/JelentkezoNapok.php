<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Concerns\AsPivot;

/**
 * @property int $ID_jelentkezo
 * @property int $ID_napok
 */
class JelentkezoNapok extends BaseModel
{
    use AsPivot;
    protected $table = "jelentkezo_napok";
}
