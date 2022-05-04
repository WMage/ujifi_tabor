<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.05.04.
 * Time: 20:46
 */

namespace App\Http\Controllers\AdminTraits;

use App\Exceptions\Kiirathato\ControllerException;
use App\Http\Response\ControllerResponse;
use App\Models\Csoport;
use App\Models\Jelentkezo;
use App\Models\Tabor;
use App\Repositories\CsoportRepository;
use App\Repositories\JelentkezoRepository;
use App\Repositories\TaborRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

trait TaborKezelesTrait
{
    /**
     * @param Request $request
     * @return ControllerResponse
     * @throws \App\Exceptions\Kiirathato\ErvenytelenJogException
     * @throws \App\Exceptions\Kiirathato\OlvasasiJogHianyzikException
     * @throws \App\Exceptions\Kiirathato\SzerkesztesiJogHianyzikException
     * @throws \ReflectionException
     * @throws ControllerException
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
     * @param int $tabor_id
     * @param array $data
     * @return Csoport
     * @throws \App\Exceptions\Kiirathato\ErvenytelenJogException
     * @throws \App\Exceptions\Kiirathato\OlvasasiJogHianyzikException
     * @throws \App\Exceptions\Kiirathato\SzerkesztesiJogHianyzikException
     * @throws \ReflectionException
     * @throws ControllerException
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
     * @throws \App\Exceptions\Kiirathato\ErvenytelenJogException
     * @throws \App\Exceptions\Kiirathato\OlvasasiJogHianyzikException
     * @throws \App\Exceptions\Kiirathato\SzerkesztesiJogHianyzikException
     * @throws \ReflectionException
     * @throws ControllerException
     */
    public function tabor(int $id, Request $request): ControllerResponse
    {
        return new ControllerResponse("tabor.admin.tabor", compact("id"));
    }
}
