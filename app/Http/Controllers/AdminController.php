<?php

namespace App\Http\Controllers;

use App\Models\Csoport;
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
        return view("tabor/admin/groups")->with(compact("csoportok", "jelentkezok", "csopvez"));
    }

    public function csoportSzerkeszt(int $id, Request $request)
    {
        $csoport = Csoport::findOrFail($id);
        if (!empty($data = $request->all())) {
            $csoport->update($data);
        }
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
                "ertekek" => $csoport->tabor->lehetsegesCsopVezJelentkezok,
                "kulcsok" => ["ID", "getTeljesNevMunkakkal"]
            ],
            "ID_vezeto2" => [
                "cim" => trans("csoport.vezeto") . " 2",
                "ertek" => ($v = $csoport->vezeto2) ? $v->ID : null,
                "ertekek" => $csoport->tabor->lehetsegesCsopVezJelentkezok,
                "kulcsok" => ["ID", "getTeljesNevMunkakkal"]
            ],
        ];
        return view("tabor/admin/edit")->with(compact("module", "cim", "action", "mezok"));
    }
}
