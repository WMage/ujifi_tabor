<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
 * @property Collection|Jelentkezo[] $lehetsegesCsopVezJelentkezok
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
            "ID_tabor",
            "ID"
        );
    }

    public function lehetsegesCsopVezJelentkezok()
    {
        suspend_sql_full_group_mode();
        $tS = Segitomunka::getTableName();
        $tJS = JelentkezoSegitomunka::getTableName();
        $tJ = Jelentkezo::getTableName();
        return $this->csopNelkuliJelentkezok()->leftJoin(
            $tJS,
            $tJS . ".ID_jelentkezo",
            "=",
            $tJ . ".ID"
        )->leftJoin($tS, function (JoinClause $query) use ($tS, $tJS) {
            return $query
                ->on($tS . ".ID", "=", $tJS . ".ID_segito_munka")
                ->where($tS . ".alias", "=", "csoport_vezeto");
        })
            ->select([
                $tJ . ".*",
                //DB::raw("IF(".$tS.".alias is null, )
                $tS . ".alias"
            ])
            ->orderBy($tS . ".alias", "DESC")
            ->orderBy($tJ . ".ID")
            ->groupBy([$tJ . ".ID"]);
    }

    public function csopNelkuliJelentkezok()
    {
        return $this->jelentkezok()->whereNull("ID_csoport");
    }
}