<?php

namespace App\Http\Controllers;

use App\Http\Response\ControllerResponse;
use App\Repositories\NapokRepository;
use App\Repositories\TaborRepository;

class IndexController extends Controller
{
    /**
     * @return ControllerResponse
     * @throws \ReflectionException
     */
    public function index()
    {
        if ($this->_jelentkezesVegrehajtasiKiserlet()) {
            return $this->_jelentkezesSikeresVisszajelzes();
        }
        return $this->_jelentkezesMegjelenitese();
    }

    /**
     * @return ControllerResponse
     * @throws \ReflectionException
     */
    private function _jelentkezesMegjelenitese()
    {
        $taborRepository = TaborRepository::getInstance();

        //<editor-fold desc="TABOR_SELECT">
        $tabor_list = $taborRepository->getElerhetoTaborok();
        if ($tabor_list->isEmpty()) {
            return new ControllerResponse(
                'tabor.jelentkezes',
                compact("tabor_list")
            );
        }
        $tabor_id = $taborRepository->getKijeloltTaborId() ?: $tabor_list->first()->ID;
        //</editor-fold>

        //<editor-fold desc="TABOR_NAPOK">
        $napokRepository = NapokRepository::getInstance();
        $selected_tabor_napok_list = $this->request->post('tabor_napok_lista') ?: [];
        $tabor_napok_list = $napokRepository->getTaborNapok($tabor_id);
        //</editor-fold>


        $dieta_list = [];
        $selected_dieta_list = [];
        $segito_munka_list = [];
        $selected_segito_munka_list = [];
        $aszf = "";
        return new ControllerResponse(
            'tabor.jelentkezes',
            compact(
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

    private function _jelentkezesVegrehajtasiKiserlet(): bool
    {
        if ($this->request->method() !== 'POST') {
            return false;
        }
        //jelentkezés rögzítése
        return false;
    }

    private function _jelentkezesSikeresVisszajelzes()
    {
        //jelentkezés sikeres volt, email küldés + display a frontnak
    }

}
