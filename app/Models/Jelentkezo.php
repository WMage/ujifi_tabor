<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
 * @property boolean $taborba_megerkezett
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
 * @property Aszf $aszf
 * @property Collection|Jog[] jogok
 * @property Collection|Segitomunka[] munkak
 * @property Collection|Napok[] napok
 */
class Jelentkezo extends BaseModel
{
    protected $table = 'jelentkezo';

    protected $fillable = [
        'ID',
        'ID_tabor',
        'nev_elotag',
        'nev_vezetek',
        'nev_kereszt',
        'email',
        'szuletesnap',
        'nevnap',
        'szallas_kulcsszo',
        'nem',
        'eloleg',
        'eloleg_megerkezett',
        'taborba_megerkezett',
        'ID_szallasszoba',
        'ID_csoport',
        'ID_aszf',
        'DATE_creation',
        'DATE_lastmod',
        'ID_szerepkor',
        'ID_user',
        'MOD_user',
    ];

    protected $casts = [
        'ID' => 'int',
        'ID_tabor' => 'int',
        'nev_elotag' => 'string',
        'nev_vezetek' => 'string',
        'nev_kereszt' => 'string',
        'email' => 'string',
        'szallas_kulcsszo' => 'string',
        'nem' => 'string',
        'eloleg' => 'int',
        'taborba_megerkezett' => 'boolean',
        'ID_szallasszoba' => 'int',
        'ID_csoport' => 'int',
        'ID_aszf' => 'int',
        'ID_szerepkor' => 'int',
        'ID_user' => 'int',
        'MOD_user' => 'int',
    ];

    protected $dates = [
        'DATE_creation',
        'DATE_lastmod',
        'nevnap',
        'szuletesnap',
        'eloleg_megerkezett',
    ];

    public function szerepkor(): HasOne
    {
        return $this->hasOne(
            Szerepkor::class,
            "ID",
            "ID_szerepkor"
        );
    }

    public function aszf(): HasOne
    {
        return $this->hasOne(
            Aszf::class,
            "ID",
            "ID_aszf"
        );
    }

    public function jogok(): HasManyThrough
    {
        return $this
            ->hasManyThrough(
                Jog::class,
                JelentkezoJog::class,
                "ID_jelentkezo",
                "ID",
                "ID",
                "ID_jog"
            )/*->select([
                Jog::getTableName() . ".*",
                JelentkezoJog::getTableName() . ".szerkesztheti"
            ])*/ ;
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

    public function munkak(): HasManyThrough
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

    public function napok(): HasManyThrough
    {
        return $this->hasManyThrough(
            Napok::class,
            JelentkezoNapok::class,
            "ID_jelentkezo",
            "ID",
            "ID",
            "ID_napok"
        );
    }

    public function csoport(): HasOne
    {
        return $this->hasOne(
            Csoport::class,
            "ID",
            "ID_csoport"
        );
    }

    public function getVezetettCsoport(): Collection
    {
        return Csoport::where('ID_vezeto1', '=', $this->ID)
            ->orWhere('ID_vezeto2', '=', $this->ID)
            ->get();
    }

}
