<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Concerns\AsPivot;

/**
 * @property int $ID_szerepkor
 * @property int $ID_jog
 */
class SzerepkorJog extends BaseModel
{
    use AsPivot;
    protected $table = "szerepkor_jog";
}