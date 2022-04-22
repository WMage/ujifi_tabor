<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int $ID
 * @property int $ID_tabor
 * @property string $nev_elotag
 * @property string $nev_vezetek
 * @property string $nev_kereszt
 * @property string $email
 * @property Carbon|string $szuletesnap
 * @property Carbon|string $nevnap
 * @property string $szallas_kulcsszo
 * @property string $nem
 * @property int $eloleg
 * @property Carbon|string $eloleg_megerkezett
 * @property int $ID_szallasszoba
 * @property int $ID_csoport
 * @property int $ID_aszf
 * @property Carbon|string $DATE_creation
 * @property Carbon|string $DATE_lastmod
 * @property int $ID_user
 * @property int $MOD_user
 *
 * --relations
 * @property Szerepkor szerepkor
 * @property Csoport csoport
 * @property Collection|Jog[] jogok
 * @property Collection|Segitomunka[] munkak
 */
class Jelentkezo extends BaseModel
{
    protected $table = "jelentkezo";

    public function szerepkor()
    {
        return $this->hasOne(
            Szerepkor::class,
            "ID",
            "ID_szerepkor"
        );
    }

    public function jogok()
    {
        return $this
            ->hasManyThrough(
                Jog::class,
                JelentkezoJog::class,
                "ID_jelentkezo",
                "ID",
                "ID",
                "ID_jog"
            )
            ->select([
                Jog::getTableName() . ".*",
                JelentkezoJog::getTableName() . ".szerkesztheti"
            ]);
    }

    public function getTeljesNev(): string
    {
        return implode(" ", [$this->nev_elotag, $this->nev_vezetek, $this->nev_kereszt]);
    }

    public function getTeljesNevMunkakkal(): string
    {
        return $this->getTeljesNev() . "(" .
            implode(", ", $this->munkak->pluck("megnevezes")->toArray())
            . ")";
    }

    public function munkak()
    {
        return $this->hasManyThrough(
            Segitomunka::class,
            JelentkezoSegitomunka::class,
            "ID_jelentkezo",
            "ID",
            "ID",
            "ID_segito_munka"
        );
    }

    public function csoport()
    {
        return $this->hasOne(
            Csoport::class,
            "ID",
            "ID_csoport"
        );
    }

    public function getVezetettCsoport()
    {
        return $this->belongsTo(
            Csoport::class,
            "ID",
            "ID_vezeto1"
        )->get()->merge(
            $this->belongsTo(
                Csoport::class,
                "ID",
                "ID_vezeto2"
            )->get()
        );
    }

}