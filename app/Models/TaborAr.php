<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property int $ID_tabor
 * @property int|null $AR_reggeli
 * @property int|null $AR_tizorai
 * @property int|null $AR_ebed
 * @property int|null $AR_uzsonna
 * @property int|null $AR_vacsora
 * @property int|null $AR_jelenlet
 * @property int|null $AR_szallas
 * @property int|null $ID_kor
 * @property int|null $ID_kedvdatum
 *
 * --relations //TODO relations
 * @property Tabor $tabor
 * @property Kor $kor
 * @property KedvezmenyesDatum $kedvezmenyesDatum
 *
 */
class TaborAr extends BaseModel
{
    protected $table = 'taborar';
    protected $primaryKey = 'ID_tabor';
    public $incrementing = false;

    protected $casts = [
        'ID_tabor' => 'int',
        'AR_reggeli' => 'int',
        'AR_tizorai' => 'int',
        'AR_ebed' => 'int',
        'AR_uzsonna' => 'int',
        'AR_vacsora' => 'int',
        'AR_jelenlet' => 'int',
        'AR_szallas' => 'int',
        'ID_kor' => 'int',
        'ID_kedvdatum' => 'int',
    ];

    protected $fillable = [
        'ID',
        'AR_reggeli',
        'AR_tizorai',
        'AR_ebed',
        'AR_uzsonna',
        'AR_vacsora',
        'AR_jelenlet',
        'AR_szallas',
        'ID_kor',
        'ID_kedvdatum',
    ];

    public function tabor(): BelongsTo
    {
        return $this->belongsTo(
            Tabor::class,
            "ID_tabor",
            "ID"
        );
    }

    public function kedvezmenyesDatum(): HasOne
    {
        return $this->hasOne(
            KedvezmenyesDatum::class,
            "ID_kedvdatum",
            "ID"
        );
    }
}
