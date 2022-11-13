<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Models\Dieta;
use App\Models\Segitomunka;
use Illuminate\Support\Str;

/**
 * Class SegitomunkaRepository
 * @package App\Repositories
 *
 * @method static SegitomunkaRepository getInstance()
 */
class SegitomunkaRepository extends MainRepository
{
    /** @var string|Dieta */
    protected $model = Segitomunka::class;

    public function ujErtekSzovegbol(string $bemenet): array
    {
        $darabok = explode(',', $bemenet);
        $ret = [];
        foreach ($darabok as $k => $megnevezes) {
            $ret[] = $this::firstOrCreate(['megnevezes' => $megnevezes]);
        }
        return $ret;
    }
}
