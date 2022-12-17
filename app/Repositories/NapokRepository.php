<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Entities\TaborArCollectionEntity;
use App\Models\Napok;
use App\Models\Tabor;
use App\Models\TaborAr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Class NapokRepository
 * @package App\Repositories
 *
 * @method static NapokRepository getInstance()
 */
class NapokRepository extends MainRepository
{
    /** @var string|Napok */
    protected $model = Napok::class;

    public function getTaborNapok(int $taborId): array
    {
        return $this->model::where('ID_tabor', '=', $taborId)
            ->orderBy('datum')
            ->getQuery()
            ->getArray();
    }

    public function getTaborSzallas(int $taborId): array
    {
        return $this->model::where('ID_tabor', '=', $taborId)
            ->where('szallas_kerheto', '=', 1)
            ->orderBy('datum')
            ->getQuery()
            ->getArray();
    }

    public function getTaborEtkezes(int $taborId): array
    {
        return $this->model::where('ID_tabor', '=', $taborId)
            ->where(function(Builder $q) use($taborId) {
                $taborAr = new TaborArCollectionEntity($taborId);
                return $q
                    ->when($taborAr->vanReggeli(), function (Builder $q){
                        return $q->orWhere('reggeli_kerheto', '=', 1);
                    })
                    ->when($taborAr->vanTizorai(), function (Builder $q){
                        return $q->orWhere('tizorai_kerheto', '=', 1);
                    })
                    ->when($taborAr->vanEbed(), function (Builder $q){
                        return $q->orWhere('ebed_kerheto', '=', 1);
                    })
                    ->when($taborAr->vanUzsonna(), function (Builder $q){
                        return $q->orWhere('uzsonna_kerheto', '=', 1);
                    })
                    ->when($taborAr->vanVacsora(), function (Builder $q){
                        return $q->orWhere('vacsora_kerheto', '=', 1);
                    });
            })
            ->orderBy('datum')
            ->getQuery()
            ->getArray();
    }
}
