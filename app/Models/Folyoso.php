<?php

namespace App\Models;

/**
 * @property int $ID
 * @property string $megnevezes
 * @property string $utca_hsz
 * @property int $irszam
 * @property string $lakokneme
 */
class Folyoso extends BaseModel
{
    protected $table = "folyoso";

    protected $fillable = [
        'ID',
        'megnevezes',
    ];

    protected $casts = [
        'ID' => 'int',
        'megnevezes' => 'string',
    ];
}
