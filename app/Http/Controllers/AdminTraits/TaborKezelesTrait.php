<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.05.04.
 * Time: 20:46
 */

namespace App\Http\Controllers\AdminTraits;

use App\Exceptions\Kiirathato\ErvenytelenJogException;
use App\Exceptions\Kiirathato\OlvasasiJogHianyzikException;
use App\Exceptions\Kiirathato\SzerkesztesiJogHianyzikException;
use App\Http\Response\ControllerResponse;
use App\Models\Tabor;
use App\Repositories\TaborRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use ReflectionException;

trait TaborKezelesTrait
{
    /**
     * @param Request $request
     * @return ControllerResponse
     * @throws ErvenytelenJogException
     * @throws OlvasasiJogHianyzikException
     * @throws ReflectionException
     * @throws SzerkesztesiJogHianyzikException
     */
    public function taborok(Request $request): ControllerResponse
    {
        userCan("megtekint.taborok");
        $taborok = UserRepository::getInstance()->getHozzaferhetoTaborok();
        if (!is_null($request->get("uj_tabor"))) {
            $this->ujTabor($request->all());
        }
        return new ControllerResponse("tabor.admin.taborok", compact("taborok"));
    }

    /**
     * @param array $data
     * @return Tabor
     * @throws ErvenytelenJogException
     * @throws OlvasasiJogHianyzikException
     * @throws SzerkesztesiJogHianyzikException
     * @throws ReflectionException
     */
    public function ujTabor(array $data): Tabor
    {
        userCan("szerkeszt.taborok");
        return TaborRepository::getInstance()->taborLetrehozasa($data);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return ControllerResponse
     */
    public function tabor(int $id, Request $request): ControllerResponse
    {
        return new ControllerResponse("tabor.admin.tabor", compact("id"));
    }
}
