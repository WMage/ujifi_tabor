<?php

namespace App\Models;

use Carbon\Carbon;

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
}