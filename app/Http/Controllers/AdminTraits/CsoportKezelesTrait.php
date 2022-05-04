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
use App\Repositories\CsoportRepository;
use App\Repositories\JelentkezoRepository;
use App\Repositories\TaborRepository;
use Illuminate\Http\Request;

trait CsoportKezelesTrait
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
    public function csoportok(Request $request): ControllerResponse
    {
        $tabor = TaborRepository::getInstance()->getKijeloltTabor();
        if (!is_null($request->get("uj_csoport"))) {
            $this->ujCsoport($tabor->ID, $request->all());
        }
        $csoportok = $tabor->csoportok;
        $jelentkezok = $tabor->csopNelkuliJelentkezok;
        $csopvez = $tabor->lehetsegesCsopVezJelentkezok;
        return new ControllerResponse("tabor.admin.csoportok", compact("csoportok", "jelentkezok", "csopvez"));
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
    public function ujCsoport(int $tabor_id, array $data): Csoport
    {
        userCan("szerkeszt.csoportok");
        $data["ID_tabor"] = $tabor_id;
        return CsoportRepository::getInstance()->insertUpdateCsoport($data);
    }

    /**
     * @param Csoport $csoport
     * @param array $tagIDs
     * @throws \App\Exceptions\Kiirathato\ErvenytelenJogException
     * @throws \App\Exceptions\Kiirathato\OlvasasiJogHianyzikException
     * @throws \App\Exceptions\Kiirathato\SzerkesztesiJogHianyzikException
     * @throws \ReflectionException
     * @throws ControllerException
     */
    public function csoporthozUjTagok(Csoport $csoport, array $tagIDs)
    {
        userCan("szerkeszt.csoportok");
        foreach (array_filter($tagIDs) as $tag_ID) {
            $jelentkezo = Jelentkezo::find($tag_ID);
            if (!is_null($jelentkezo->ID_csoport)) {
                throw new ControllerException($jelentkezo->getTeljesNev() . "Már tagja a " . $jelentkezo->csoport->nevID . " csoportnak, így nem adható hozzá a kijelölt csoporthoz [" . $csoport->nevID . "]");
            } elseif (!($csoportok = $jelentkezo->getVezetettCsoport())->isEmpty()) {
                $csoportok = $csoportok->pluck("nevID")->toArray();
                array_unique($csoportok);
                throw new ControllerException($jelentkezo->getTeljesNev() . " már vezetője a " . implode(",", $csoportok) . " csoportnak, így nem adható hozzá tagként a kijelölt csoporthoz [" . $csoport->nevID . "]");
            } else {
                $jelentkezo->ID_csoport = $csoport->ID;
                $jelentkezo->save();
            }
        }
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
    public function csoport(int $id, Request $request): ControllerResponse
    {
        $csoport = Csoport::findOrFail($id);
        if ($request->get("action") === "tag_hozzaad") {
            $this->csoporthozUjTagok($csoport, $request->get("uj_tag"));
        } elseif ($request->get("action") === "tag_torol") {
            JelentkezoRepository::getInstance()->csoportbolTorles($request->get("tag_ID"));
        } elseif (!empty($data = $request->all())) {
            $csoport = CsoportRepository::getInstance()->insertUpdateCsoport($data, $csoport);
        }
        $tagok = $csoport->tagok;
        $csopNelkuliJelentkezok = $csoport->tabor->csopNelkuliJelentkezok;
        $lehetsegesCsopVezJelentkezok = $csoport->tabor->lehetsegesCsopVezJelentkezok->merge($csoport->getVezetok());
        $module = trans("csoport.cim");
        $cim = $csoport->nev;
        $action = "";
        $mezok = [
            "nev" => [
                "cim" => trans("altalanos.nev"),
                "ertek" => $csoport->nev
            ],
            "hely" => [
                "cim" => trans("csoport.csoport_hely"),
                "ertek" => $csoport->hely
            ],
            "ID_vezeto1" => [
                "cim" => trans("csoport.vezeto") . " 1",
                "ertek" => ($v = $csoport->vezeto1) ? $v->ID : null,
                "ertekek" => $lehetsegesCsopVezJelentkezok,
                "kulcsok" => ["ID", "getTeljesNevMunkakkal"]
            ],
            "ID_vezeto2" => [
                "cim" => trans("csoport.vezeto") . " 2",
                "ertek" => ($v = $csoport->vezeto2) ? $v->ID : null,
                "ertekek" => $lehetsegesCsopVezJelentkezok,
                "kulcsok" => ["ID", "getTeljesNevMunkakkal"]
            ],
        ];
        return new ControllerResponse("tabor.admin.csoport", compact("module", "cim", "action", "mezok", "tagok", "csopNelkuliJelentkezok"));
    }
}
