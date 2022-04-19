<?php

namespace App\Http\Controllers;

use App\Repositories\TaborRepository;

class IndexController extends Controller
{
    /** @var TaborRepository */
    protected $taborRepository;

    /**
     * IndexController constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        $this->taborRepository = TaborRepository::getInstance();
    }

    public function index()
    {
        $tabor_list = $this->taborRepository->getElerhetoTaborok();
        $tabor_id = $this->taborRepository->getKijeloltTaborId();
        $tabor_napok_list = [];
        $selected_tabor_napok_list = [];
        $dieta_list = [];
        $selected_dieta_list = [];
        $segito_munka_list = [];
        $selected_segito_munka_list = [];
        $aszf = "";
        return view('tabor/jelentkezes')
            ->with(compact(
                "tabor_list",
                "tabor_id",
                "tabor_napok_list",
                "selected_tabor_napok_list",
                "dieta_list",
                "selected_dieta_list",
                "segito_munka_list",
                "selected_segito_munka_list",
                "aszf"
            ));
    }

}
