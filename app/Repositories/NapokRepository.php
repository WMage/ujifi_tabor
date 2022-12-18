<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Entities\TaborArCalculatorEntity;
use App\Models\Napok;
use Illuminate\Database\Eloquent\Builder;

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
        $taborAr = TaborArCalculatorEntity::getInstance($taborId);
        if (!$taborAr->vanSzallas()) {
            return [];
        }
        return $this->model::where('ID_tabor', '=', $taborId)
            ->where('szallas', '=', 1)
            ->orderBy('datum')
            ->getQuery()
            ->getArray();
    }

    public function getTaborEtkezes(int $taborId): array
    {
        $taborAr = TaborArCalculatorEntity::getInstance($taborId);
        if (!$taborAr->vanEtkezes()) {
            return [];
        }
        return $this->model::where('ID_tabor', '=', $taborId)
            ->where(function (Builder $q) use ($taborAr) {
                return $q
                    ->when($taborAr->vanReggeli(), function (Builder $q) {
                        return $q->orWhere('reggeli', '=', 1);
                    })
                    ->when($taborAr->vanTizorai(), function (Builder $q) {
                        return $q->orWhere('tizorai', '=', 1);
                    })
                    ->when($taborAr->vanEbed(), function (Builder $q) {
                        return $q->orWhere('ebed', '=', 1);
                    })
                    ->when($taborAr->vanUzsonna(), function (Builder $q) {
                        return $q->orWhere('uzsonna', '=', 1);
                    })
                    ->when($taborAr->vanVacsora(), function (Builder $q) {
                        return $q->orWhere('vacsora', '=', 1);
                    });
            })
            ->orderBy('datum')
            ->getQuery()
            ->getArray();
    }
}
