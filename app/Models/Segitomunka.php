<?php

namespace App\Models;

/**
 * @property int $ID
 * @property string $megnevezes
 * @property string $alias
 */
class Segitomunka extends BaseModel
{
    protected $table = "segitomunka";

    public function setMegnevezesAttribute($value)
    {
        $this->attributes["megnevezes"] = $value;
        $this->alias = str_replace(" ", "_", iconv("UTF-8", "ASCII//TRANSLIT", $value));
    }
}