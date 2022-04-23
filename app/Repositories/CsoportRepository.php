<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Models\Csoport;

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

    public function insertUpdateCsoport(array $data, ?Csoport $model = null): Csoport
    {
        if (array_key_exists("ID_vezeto1", $data) && !empty($data["ID_vezeto1"]) && $data["ID_vezeto1"] !== "null") {
            if (Csoport::vezetiE($data["ID_vezeto1"])->exists()) {
                unset($data["ID_vezeto1"]);
            }
        }
        if (array_key_exists("ID_vezeto2", $data) && !empty($data["ID_vezeto2"]) && $data["ID_vezeto2"] !== "null") {
            if (Csoport::vezetiE($data["ID_vezeto2"])->exists()) {
                unset($data["ID_vezeto2"]);
            }
        }
        if(empty($model)){
            return $this->model::create($data);
        }
        $model->update($data);
        return $model;
    }
}