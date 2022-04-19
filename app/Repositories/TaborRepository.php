<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Models\Tabor;

class TaborRepository extends MainRepository
{
    /** @var string|Tabor */
    protected $model = Tabor::class;

    public function getElerhetoTaborok(): array
    {
        return
            $this->model::select(["ID", "nev"])
                ->whereRaw("REG_start < NOW()")
                ->whereRaw("REG_end > NOW()")
                ->getQuery()->getArray();
    }

    public function getOsszesTaborok(): array
    {
        return
            $this->model::select(["ID", "nev"])->getQuery()->getArray();
    }

    public function setKijeloltTaborId(int $taborId)
    {
        $this->setClassSessionData("tabor_id", $taborId);
    }

    public function getKijeloltTaborId(): ?int
    {
        return $this->getClassSessionData("tabor_id");
    }
}