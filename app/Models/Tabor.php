<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property int $ID
 * @property string $motto
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
 *
 * -scopes
 * @method static Builder regisztracioAktiv()
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
        return $this->hasMany(
            Napok::class,
            "ID_tabor",
            "ID"
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
                $tS . ".alias"
            ])
            ->orderBy($tS . ".alias", "DESC")
            ->orderBy($tJ . ".ID")
            ->groupBy([$tJ . ".ID"]);
    }

    //akik csoportba se tartoznak és nem is csoportvezetők még
    public function csopNelkuliJelentkezok()
    {
        $vezetok = array_merge(
            $this->csoportok->whereNotNull("ID_vezeto1")->pluck("ID_vezeto1")->toArray(),
            $this->csoportok->whereNotNull("ID_vezeto2")->pluck("ID_vezeto2")->toArray()
        );
        //dd($vezetok);
        return $this->jelentkezok()->whereNull("ID_csoport")
            ->whereIntegerNotInRaw(Jelentkezo::getTableName() . ".ID", $vezetok);
    }

    public function scopeRegisztracioAktiv(Builder $builder)
    {
        return $builder
            ->where(function (Builder $b){
                return $b
                    ->orWhere("REG_start", "<=", DB::raw("now()"))
                    ->orWhereNull("REG_start");
            })
            ->where(function (Builder $b){
                return $b
                    ->orWhere("REG_end", ">=", DB::raw("now()"))
                    ->orWhereNull("REG_end");
            });
    }

    public function regisztracioAktivE()
    {
        $now = new Carbon();
        return $this->REG_start <= $now && $this->REG_end >= $now;
    }
}