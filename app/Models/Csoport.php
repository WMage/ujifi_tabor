<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
 *
 * --virtual attributes
 * @property string nevID
 *
 * -scopes
 * @method static Builder VezetE(int $jelentkezoId)
 */
class Csoport extends BaseModel
{
    protected $table = "csoport";

    protected $fillable = [
        "nev",
        "hely",
        "ID_vezeto1",
        "ID_vezeto2",
        "ID_tabor",
    ];

    protected $casts = [
        "ID" => "int",
        "nev" => "string",
        "hely" => "string",
        "ID_vezeto1" => "int",
        "ID_vezeto2" => "int",
        "ID_tabor" => "int",
    ];

    public function vezeto1(): HasOne
    {
        return $this->hasOne(
            Jelentkezo::class,
            "ID",
            "ID_vezeto1"
        );
    }

    public function vezeto2(): HasOne
    {
        return $this->hasOne(
            Jelentkezo::class,
            "ID",
            "ID_vezeto2"
        );
    }

    public function getVezetok(): Collection
    {
        $ret = collect([]);
        if ($this->vezeto1) {
            $ret->add($this->vezeto1);
        }
        if ($this->vezeto2) {
            $ret->add($this->vezeto2);
        }
        return $ret;
    }

    public function tagok(): HasMany
    {
        return $this->hasMany(
            Jelentkezo::class,
            "ID_csoport",
            "ID"
        );
    }

    public function tabor(): BelongsTo
    {
        return $this->belongsTo(
            Tabor::class,
            "ID_tabor",
            "ID"
        );
    }

    public function scopeVezetE(Builder $builder, int $jelentkezoID)
    {
        return $builder->where("ID_vezeto1", "=", $jelentkezoID)->orWhere("ID_vezeto2", "=", $jelentkezoID);
    }

    public function getNevAttribute(): string
    {
        return $this->attributes["nev"] ?: "-Név nélküli-";
    }

    public function getNevIDAttribute(): string
    {
        return $this->getNevAttribute() . "( ID: " . $this->ID . " )";
    }
}
