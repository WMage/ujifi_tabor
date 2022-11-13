<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * @property int $ID
 * @property Carbon|string $DATE_creation
 * @property string $text
 */
class Aszf extends BaseModel
{
    protected $table = "aszf";

    protected $fillable = [
        'ID',
        'DATE_creation',
        'text',
    ];

    protected $casts = [
        'ID' => 'int',
        'text' => 'string',
    ];

    protected $dates = [
        'DATE_creation',
    ];
}
