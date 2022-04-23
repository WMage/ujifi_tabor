<?php

namespace App\Http\Controllers;

use App\Models\Csoport;
use App\Models\Jelentkezo;
use App\Models\Tabor;
use App\Repositories\CsoportRepository;
use App\Repositories\TaborRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        //return $user->getOsszesJog();
        return view('home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \ReflectionException
     */
    public function csoportok(Request $request)
    {
        TaborRepository::getInstance()->setKijeloltTaborId(1);
        $tabor = TaborRepository::getInstance()->getKijeloltTabor();
        if (!empty($data = $request->all())) {
            //dd($data);
            $data["ID_tabor"] = $tabor->ID;
            CsoportRepository::getInstance()->insertUpdateCsoport($data);
        }
        $csoportok = $tabor->csoportok;
        $jelentkezok = $tabor->csopNelkuliJelentkezok;
        $csopvez = $tabor->lehetsegesCsopVezJelentkezok;
        return view("tabor.admin.csoportok")->with(compact("csoportok", "jelentkezok", "csopvez"));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \ReflectionException
     */
    public function csoport(int $id, Request $request)
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
        return view("tabor.admin.csoport")->with(compact("module", "cim", "action", "mezok", "tagok", "csopNelkuliJelentkezok"));
    }
}
