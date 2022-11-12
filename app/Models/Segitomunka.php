<?php

namespace App\Models;

use Illuminate\Support\Str;

/**
 * @property int $ID
 * @property string $megnevezes
 * @property string $alias
 */
class Segitomunka extends BaseModel
{
    protected $table = "segitomunka";
    protected $fillable = ['ID', 'megnevezes'];

    public function setMegnevezesAttribute($value)
    {
        $this->attributes["megnevezes"] = $value;
        $this->alias = Str::slug($value, '_');/*str_replace(" ", "_", iconv("UTF-8", "ASCII//TRANSLIT", $value));*/
    }
}