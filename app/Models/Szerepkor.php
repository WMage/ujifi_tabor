<?php

namespace App\Models;

use Illuminate\Support\Collection;

/**
 * @property int $ID
 * @property string $nev
 * @property string $leiras
 * @property boolean $isEnabled
 *
 * --relations
 * @property Collection|Jog[] jogok
 */
class Szerepkor extends BaseModel
{
    protected $table = "szerepkor";
    protected $primaryKey = "ID";
    public $timestamps = false;

    protected $fillable = [
        "ID",
        "nev",
        "leiras",
        "isEnabled"
    ];

    protected $casts = [
        'ID' => 'int',
        "nev" => "string",
        "leiras" => "string",
        "isEnabled" => "boolean"
    ];

    public function jogok()
    {
        return $this
            ->hasManyThrough(
                Jog::class,
                SzerepkorJog::class,
                "ID_szerepkor",
                "ID",
                "ID",
                "ID_jog"
            )
            /*->select([
                Jog::getTableName() . ".*",
                SzerepkorJog::getTableName() . ".szerkesztheti"
            ])*/;
    }
}
