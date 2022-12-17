<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int $ID
 * @property Carbon|string $datum
 * @property int $ID_tabor
 * @property int $merteke
 *
 * --relations
 * @property Tabor $tabor
 * @property Collection|TaborAr[] $taborArak
 */
class KedvezmenyesDatum extends BaseModel
{
    protected $table = "kedvezmenyes_datum";
    protected $primaryKey = "ID";
    public $timestamps = false;

    protected $fillable = [
        "ID",
        "datum",
        "ID_tabor",
        "merteke"
    ];

    protected $casts = [
        'ID' => 'int',
        "ID_tabor" => "int",
        "merteke" => "int"
    ];

    protected $dates = ['datum'];

}
