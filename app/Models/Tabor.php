<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int $ID
 * @property string $nev
 * @property int $ID_aszf
 * @property string $varos
 * @property string $cim
 * @property int $ferohely
 * @property int $kor_min
 * @property int $kor_max
 * @property Carbon|string $REG_start
 * @property Carbon|string $REG_end
 * @property Carbon|string $DATE_creation
 * @property Carbon|string $DATE_lastmod
 *
 * --relations
 * @property Collection|Napok[] $napok
 * @property Collection|Csoport[] $csoportok
 * @property Collection|Jelentkezo[] $jelentkezok
 * @property Collection|Jelentkezo[] $csopVezJelentkezok
 * @property Collection|Jelentkezo[] $csopNelkuliJelentkezok
 */
class Tabor extends BaseModel
{
    protected $table = "tabor";

    public function lezarult(): bool
    {
        return (new \Illuminate\Support\Carbon())->isAfter(
            $this->napok->max(function (Napok $a) {
                return $a->datum;
            }));
    }

    public function napok()
    {
        return $this->hasManyThrough(
            Napok::class,
            TaborNapok::class,
            "ID_tabor",
            "ID",
            "ID",
            "ID_napok"
        );
    }

    public function csoportok()
    {
        return $this->hasMany(
            Csoport::class,
            "ID_tabor",
            "ID"
        );
    }

    public function jelentkezok()
    {
        return $this->hasMany(
            Jelentkezo::class,
            "ID_csoport",
            "ID"
        );
    }

    public function csopVezJelentkezok()
    {
        return $this->jelentkezok()->join(

        );
    }

    public function csopNelkuliJelentkezok()
    {
        return $this->jelentkezok()->whereNull("ID_csoport");
    }
}