<?php

namespace App\Models;

/**
 * @property int $ID
 * @property string $megnevezes
 * @property int $szint
 */
class Emelet extends BaseModel
{
    protected $table = "emelet";

    protected $fillable = [
        'ID',
        'megnevezes',
        'szint'
    ];

    protected $casts = [
        'ID' => 'int',
        'megnevezes' => 'string',
        'szint' => 'string'
    ];
}
