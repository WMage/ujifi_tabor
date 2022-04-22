<?php

namespace App\Http\Controllers;

use App\Models\Csoport;
use App\Models\Jelentkezo;
use App\Models\Tabor;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \ReflectionException
     */
    public function csoportok()
    {
        TaborRepository::getInstance()->setKijeloltTaborId(1);
        //dd(TaborRepository::getInstance()->getKijeloltTabor()->lezarult());
        $tabor = TaborRepository::getInstance()->getKijeloltTabor();
        $csoportok = $tabor->csoportok;
        $jelentkezok = $tabor->csopNelkuliJelentkezok;
        $csopvez = $tabor->lehetsegesCsopVezJelentkezok;
        // dd(TaborRepository::getInstance()->getKijeloltTabor()->csoportok);
        return view("tabor.admin.csoportok")->with(compact("csoportok", "jelentkezok", "csopvez"));
    }

    public function csoportSzerkeszt(int $id, Request $request)
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
            $csoport->update($data);
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
