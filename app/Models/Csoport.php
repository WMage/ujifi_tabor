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
 * @property Collection|Jelentkezo[] $tagok
 */
class Csoport extends BaseModel
{
    protected $table = "csoport";

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

}