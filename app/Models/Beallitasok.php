<?php

namespace App\Models;

/**
 * @property int $ID
 * @property string $kulcs
 * @property string $ertek
 * @property string $tabla
 */
class Beallitasok extends BaseModel
{
    protected $table = "aszf";

    protected $fillable = [
        'ID',
        'kulcs',
        'ertek',
        'tabla',
    ];

    protected $casts = [
        'ID' => 'int',
        'kulcs' => 'string',
        'ertek' => 'string',
        'tabla' => 'string',
    ];
}
