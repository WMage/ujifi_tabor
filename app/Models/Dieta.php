<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property int $ID
 * @property string $megnevezes
 */
class Dieta extends BaseModel
{
    protected $table = "dieta";

    protected $casts = [
        'ID' => 'int',
        'megnevezes' => 'string'
    ];

    protected $fillable = ['ID', 'megnevezes'];

    public function jelentkezok(): HasManyThrough
    {
        return $this->hasManyThrough(
            Jelentkezo::class,
            JelentkezoDieta::class,
            'ID_dieta',
            'ID',
            'ID',
            'ID_jelentkezo'
        );
    }
}
