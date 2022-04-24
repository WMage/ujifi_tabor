<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Models\Tabor;
use App\Models\User;
use Illuminate\Support\Collection;

/**
 * Class TaborRepository
 * @package App\Repositories
 *
 * @method static TaborRepository getInstance()
 */
class TaborRepository extends MainRepository
{
    /** @var string|Tabor */
    protected $model = Tabor::class;

    public function getOsszesTaborok(): Collection
    {
        return $this->model::get();
    }

    public function setKijeloltTaborId(?int $taborId): self
    {
        $this->setClassSessionData("tabor_id", $taborId);
        return $this;
    }

    public function getKijeloltTaborId(): ?int
    {
        return $this->getClassSessionData("tabor_id");
    }

    public function clearKijeloltTaborId(): self
    {
        $this->removeClassSessionData("tabor_id");
        return $this;
    }

    public function getKijeloltTabor(): ?Tabor
    {
        if (empty($taborId = $this->getKijeloltTaborId())) {
            return null;
        }
        return $this->model->find($taborId);
    }

    public function getElerhetoTaborok(): Collection
    {
        /** @var User $user */
        return $this->model::regisztracioAktiv()->get();
    }
}