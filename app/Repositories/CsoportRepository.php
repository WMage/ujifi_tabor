<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Exceptions\Kiirathato\ControllerException;
use App\Models\BaseModel;
use App\Models\Csoport;
use App\Models\Jelentkezo;

/**
 * Class CsoportRepository
 * @package App\Repositories
 *
 * @method static CsoportRepository getInstance()
 */
class CsoportRepository extends MainRepository
{
    /** @var string|Csoport */
    protected $model = Csoport::class;

    /**
     * @param array $data
     * @param Csoport|null $model
     * @return Csoport
     * @throws ControllerException
     * @throws \App\Exceptions\Kiirathato\ErvenytelenJogException
     * @throws \App\Exceptions\Kiirathato\OlvasasiJogHianyzikException
     * @throws \App\Exceptions\Kiirathato\SzerkesztesiJogHianyzikException
     * @throws \ReflectionException
     */
    public function insertUpdateCsoport(array $data, ?Csoport $model = null): Csoport
    {
        userCan("szerkeszt.csoportok");
        if (!empty($model) && $model->exists()) {
            $data = $model->fill($data)->getDirty();
            if (!$model->isDirty()) {
                //return $model;
            }
        }
        if (array_key_exists("ID_vezeto1", $data) && !empty($data["ID_vezeto1"])) {
            $vezeto1 = Jelentkezo::find($data["ID_vezeto1"]);
            if (Csoport::vezetE($data["ID_vezeto1"])->exists()) {
                throw new ControllerException(
                    $vezeto1->getTeljesNev() . " már csoportvezető"
                );
            }
            if (!empty($vezeto1->csoport)) {
                throw new ControllerException($vezeto1->getTeljesNev() . " már tagja a " . $vezeto1->csoport->nevID . " csoportnak, így nem lehet belőle csoportvezető");
            }
        }
        if (array_key_exists("ID_vezeto2", $data) && !empty($data["ID_vezeto2"])) {
            $vezeto2 = Jelentkezo::find($data["ID_vezeto2"]);
            if (Csoport::vezetE($data["ID_vezeto2"])->exists()) {
                throw new ControllerException(
                    $vezeto2->getTeljesNev() . " már csoportvezető"
                );
            }
            if (!empty($vezeto2->csoport)) {
                throw new ControllerException($vezeto2->getTeljesNev() . " már tagja a " . $vezeto2->csoport->nevID . " csoportnak, így nem lehet belőle csoportvezető");
            }
        }
        if (array_key_exists("ID_vezeto1", $data) && array_key_exists("ID_vezeto2", $data) && ($data["ID_vezeto1"] == $data["ID_vezeto2"])) {
            unset($data["ID_vezeto2"]);
        }
        if (empty($model) || !$model->exists()) {
            return $this->model::create($data);
        }
        $model->update($data);
        return $model;
    }
}
