<?php

namespace App\Models;

use Illuminate\Support\Collection;

/**
 * @property int $ID
 * @property string $nev
 * @property int $ID_vezeto1
 * @property int $ID_vezeto2
 * @property string $hely
 * @property int $ID_tabor
 *
 * --relations
 * @property Jelentkezo $vezeto1
 * @property Jelentkezo $vezeto2
 * @property Tabor $tabor
 * @property Collection|Jelentkezo[] $tagok
 */
class Csoport extends BaseModel
{
    protected $table = "csoport";
    protected $fillable = [
        "nev",
        "hely",
        "ID_vezeto1",
        "ID_vezeto2",
    ];
    protected $casts = [
        "nev" => "string",
        "hely" => "string",
        "ID_vezeto1" => "string",
        "ID_vezeto2" => "string",

    ];

    public function vezeto1()
    {
        return $this->hasOne(
            Jelentkezo::class,
            "ID",
            "ID_vezeto1"
        );
    }

    public function vezeto2()
    {
        return $this->hasOne(
            Jelentkezo::class,
            "ID",
            "ID_vezeto2"
        );
    }

    public function tagok()
    {
        return $this->hasMany(
            Jelentkezo::class,
            "ID_csoport",
            "ID"
        );
    }

    public function tabor()
    {
        return $this->belongsTo(
            Tabor::class,
            "ID_tabor",
            "ID"
        );
    }

}