<?php

namespace App\Http\Controllers;

use App\Models\Tabor;
use App\Repositories\TaborRepository;
use App\Service\Template;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /** @var TaborRepository */
    protected $taborRepository;


    /**
     * IndexController constructor.
     * @param Request $request
     * @throws \ReflectionException
     */
    public function __construct(Request $request)
    {
        $this->taborRepository = TaborRepository::getInstance();
        parent::__construct($request);
    }


    public function index()
    {
        $tabor_list = $this->taborRepository->getElerhetoTaborok();
        $tabor_id = $this->taborRepository->getKijeloltTaborId();
        $tabor_napok_list = $selected_tabor_napok_list = [["ID" => 1, "datum" => Template::getNOWStr()]];
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
