<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Models\Dieta;

/**
 * Class DietaRepository
 * @package App\Repositories
 *
 * @method static DietaRepository getInstance()
 */
class DietaRepository extends MainRepository
{
    /** @var string|Dieta */
    protected $model = Dieta::class;

    public function mentesSzovegbol(string $bemenet): array
    {
        $darabok = explode(',', $bemenet);
        $ret = [];
        foreach ($darabok as $k => $megnevezes) {
            $ret[] = $this->model::firstOrCreate(['megnevezes' => $megnevezes])->ID;
        }
        return $ret;
    }
}