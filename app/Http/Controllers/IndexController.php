<?php

namespace App\Http\Controllers;

use App\Http\Response\ControllerResponse;
use App\Models\Dieta;
use App\Models\Jelentkezo;
use App\Models\Segitomunka;
use App\Repositories\DietaRepository;
use App\Repositories\NapokRepository;
use App\Repositories\SegitomunkaRepository;
use App\Repositories\TaborRepository;

class IndexController extends Controller
{
    /**
     * @return ControllerResponse
     * @throws \ReflectionException
     */
    public function index()
    {
        if (($j=$this->_jelentkezesVegrehajtasiKiserlet())!==null) {
            return $this->_jelentkezesSikeresVisszajelzes($j);
        }
        return $this->_jelentkezesMegjelenitese();
    }

    /**
     * @return ControllerResponse
     * @throws \ReflectionException
     */
    private function _jelentkezesMegjelenitese()
    {
        $taborRepo = TaborRepository::getInstance();

        //<editor-fold desc="TABOR_SELECT">
        $tabor_list = $taborRepo->getElerhetoTaborok();
        if ($tabor_list->isEmpty()) {
            return new ControllerResponse(
                'tabor.jelentkezes',
                compact("tabor_list")
            );
        }
        $tabor_id = $taborRepo->getKijeloltTaborId() ?: $tabor_list->first()->ID;
        //</editor-fold>

        //<editor-fold desc="TABOR_NAPOK">
        $napokRepo = NapokRepository::getInstance();
        $selected_tabor_napok_list = $this->request->post('tabor_napok_lista') ?: [];
        $tabor_napok_list = $napokRepo->getTaborNapok($tabor_id);
        //</editor-fold>

        //<editor-fold desc="DIETA">
        $selected_dieta_list = $this->request->post('dieta_erzekenyseg_lista') ?: [];
        $dieta_list = Dieta::where('megnevezes', '<>', '')->get();
        //</editor-fold>

        //<editor-fold desc="SEGITO_MUNKA">
        $selected_segito_munka_list = $this->request->post('segito_munka_lista') ?: [];
        $segito_munka_list = Segitomunka::where('alias', '<>', '')->get();
        //</editor-fold>

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

    /**
     * @return bool
     * @throws \ReflectionException
     */
    private function _jelentkezesVegrehajtasiKiserlet(): ?Jelentkezo
    {
        if ($this->request->method() !== 'POST') {
            return false;
        }
        $dietaRepo = DietaRepository::getInstance();
        $dietak = $dietaRepo->ujErtekSzovegbol($this->request->post('dieta_erzekenyseg_tovabbi') ?: '');
        $segitoRepo = SegitomunkaRepository::getInstance();
        $munkak = $segitoRepo->ujErtekSzovegbol($this->request->post('segito_munka_tovabbi') ?: '');

        Jelentkezo::create([]);

        //jelentkezés rögzítése
        return false;
    }

    private function _jelentkezesSikeresVisszajelzes(Jelentkezo $jelentkezo)
    {
        //jelentkezés sikeres volt, email küldés + display a frontnak
    }

}
