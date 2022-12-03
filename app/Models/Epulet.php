<?php

namespace App\Models;

/**
 * @property int $ID
 * @property string $megnevezes
 * @property string $utca_hsz
 * @property int $irszam
 * @property string $lakokneme
 */
class Epulet extends BaseModel
{
    protected $table = "epulet";

    protected $fillable = [
        'ID',
        'megnevezes',
        'utca_hsz',
        'irszam',
        'lakokneme'
    ];

    protected $casts = [
        'ID' => 'int',
        'megnevezes' => 'string',
        'utca_hsz' => 'string',
        'irszam' => 'int',
        'lakokneme' => 'string',
    ];
}
