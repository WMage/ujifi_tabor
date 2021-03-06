<?php

namespace App\Http\Controllers;

use App\Models\Csoport;
use App\Models\Tabor;
use App\Repositories\TaborRepository;
use App\User;

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
        return $user->getOsszesJog();
        return view('home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \ReflectionException
     */
    public function groups()
    {
        dd(Tabor::find(1)->csopVezJelentkezok);
        TaborRepository::getInstance()->setKijeloltTaborId(1);
        //dd(TaborRepository::getInstance()->getKijeloltTabor()->lezarult());
        $tabor = TaborRepository::getInstance()->getKijeloltTabor();
        $csoportok = $tabor->csoportok;
        $jelentkezok = $tabor->csopNelkuliJelentkezok;
       // dd(TaborRepository::getInstance()->getKijeloltTabor()->csoportok);
        return view("tabor/admin/groups")->with(compact("csoportok", "jelentkezok"));
    }
}
