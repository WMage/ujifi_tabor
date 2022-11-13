<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Models\Jelentkezo;

/**
 * Class JelentkezoRepository
 * @package App\Repositories
 *
 * @method static self getInstance(string $name = '', array $params = array())
 */
class JelentkezoRepository extends MainRepository
{
    /** @var string|Jelentkezo */
    protected string $model = Jelentkezo::class;

    public function letezikE($nev_elotag, $nev_vezetek, $nev_kereszt, $email, $taborId, $szuletesnap): bool
    {
        return !is_null(
            $this->model::where('nev_elotag', "=", $nev_elotag)
                ->where("nev_vezetek", "=", $nev_vezetek)
                ->where("nev_kereszt", "=", $nev_kereszt)
                ->where("email", "=", $email)
                ->where("taborId", "=", $taborId)
                ->where("szuletesnap", "=", $szuletesnap)
                ->get()
        );
    }

    /**
     * @param int $jelentkezoId
     * @throws \App\Exceptions\Kiirathato\ErvenytelenJogException
     * @throws \App\Exceptions\Kiirathato\OlvasasiJogHianyzikException
     * @throws \App\Exceptions\Kiirathato\SzerkesztesiJogHianyzikException
     * @throws \ReflectionException
     */
    public function csoportbolTorles(int $jelentkezoId)
    {
        userCan("szerkeszt.csoportok");
        $this->model::whereId($jelentkezoId)->update(["ID_csoport" => null]);
    }
}
