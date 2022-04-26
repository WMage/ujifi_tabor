<?php

namespace App\Http\Controllers;

use App\Http\Response\ControllerResponse;
use App\Models\Csoport;
use App\Models\Jelentkezo;
use App\Repositories\CsoportRepository;
use App\Repositories\TaborRepository;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $user;

    protected function getUser(): User
    {
        if (empty($this->user)) {
            $this->user = auth()->user();
        }
        return $this->user;
    }

    /**
     * @return ControllerResponse
     * @throws \ReflectionException
     */
    public function index()
    {
        $user = $this->getUser();
        $tabor_list = $user->taborok;
        $tabor_id = TaborRepository::getInstance()->getKijeloltTaborId();
        return new ControllerResponse('home', compact('tabor_list', 'tabor_id'));
    }

    /**
     * @param Request $request
     * @return ControllerResponse
     * @throws \ReflectionException
     */
    public function taborok(Request $request):ControllerResponse{
        $taborok = UserRepository::getInstance()->getHozzaferhetoTaborok();
        return new ControllerResponse("tabor.admin.taborok", compact("taborok"));
    }

    //<editor-fold desc="CSOPORT">

    /**
     * @param Request $request
     * @return ControllerResponse
     * @throws \App\Exceptions\ErvenytelenJogException
     * @throws \App\Exceptions\OlvasasiJogHianyzikException
     * @throws \App\Exceptions\SzerkesztesiJogHianyzikException
     * @throws \ReflectionException
     */
    public function csoportok(Request $request):ControllerResponse
    {
        $tabor = TaborRepository::getInstance()->getKijeloltTabor();
        if (!is_null($request->get("uj_csoport"))) {
            userCan("szerkeszt.csoport.letrehoz");
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
     * @throws \ReflectionException
     */
    public function ujCsoport(int $tabor_id, array $data):Csoport{
        $data["ID_tabor"] = $tabor_id;
        return CsoportRepository::getInstance()->insertUpdateCsoport($data);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \ReflectionException
     */
    public function csoport(int $id, Request $request): ControllerResponse
    {
        $csoport = Csoport::findOrFail($id);
        if ($request->get("action") == "tag_hozzaad") {
            foreach (array_filter($request->get("uj_tag"), function ($value) {
                return !empty($value) && $value !== "null";
            }) as $tag_ID) {
                $jelentkezo = Jelentkezo::find($tag_ID);
                if (is_null($jelentkezo->ID_csoport) && $jelentkezo->getVezetettCsoport()->isEmpty()) {
                    $jelentkezo->ID_csoport = $id;
                    $jelentkezo->save();
                }
            }
        } elseif ($request->get("action") == "tag_torol") {
            Jelentkezo::whereId($request->get("tag_ID"))->update(["ID_csoport" => null]);
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
    //</editor-fold>
}
