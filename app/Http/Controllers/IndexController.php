<?php

namespace App\Http\Controllers;

use App\Entities\TaborArCalculatorEntity;
use App\Exceptions\Kiirathato\ControllerException;
use App\Http\Response\ControllerResponse;
use App\Models\Aszf;
use App\Models\Dieta;
use App\Models\Jelentkezo;
use App\Models\JelentkezoDieta;
use App\Models\JelentkezoSegitomunka;
use App\Models\Segitomunka;
use App\Models\Tabor;
use App\Repositories\DietaRepository;
use App\Repositories\NapokRepository;
use App\Repositories\SegitomunkaRepository;
use App\Repositories\TaborRepository;
use App\Http\Requests\Index\JelentkezesRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use ReflectionException;

/**
 * @property JelentkezesRequest $req
 */
class IndexController extends Controller
{
    protected $validatorReq = JelentkezesRequest::class;

    /**
     * @return ControllerResponse
     * @throws ReflectionException|ControllerException
     */
    public function index(): ControllerResponse
    {
        /*$e = TaborArCalculatorEntity::getInstance(1, 1);
        dd($e->getEtkezesAr());*/
        if (($j = $this->_jelentkezesRogzitese()) !== null) {
            return $this->_jelentkezesSikeresVisszajelzes($j);
        }
        return $this->_jelentkezesMegjelenitese();
    }

    /**
     * @return ControllerResponse
     * @throws ReflectionException
     */
    private function _jelentkezesMegjelenitese(): ControllerResponse
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

        //<editor-fold desc="ASZF">
        /** @var Tabor $tabor */
        $tabor = $taborRepo->findOrFail($tabor_id);
        $aszf = Aszf::findOrFail($tabor->ID_aszf)->text;
        //</editor-fold>

        //<editor-fold desc="TABOR_NAPOK">
        $napokRepo = NapokRepository::getInstance();
        $selected_tabor_napok_list = $this->req->tabor_napok_lista ?: [];
        $tabor_napok_list = $napokRepo->getTaborSzallas($tabor_id);
        //</editor-fold>

        //<editor-fold desc="ETKEZES">
        $napokRepo = NapokRepository::getInstance();
        $selected_tabor_etkezes_list = $this->req->tabor_etkezes_lista ?: [];
        $tabor_etkezes_list = $napokRepo->getTaborEtkezes($tabor_id);
        //dd($selected_tabor_etkezes_list, $tabor_etkezes_list);
        var_dump($selected_tabor_etkezes_list, $selected_tabor_napok_list);
        //</editor-fold>

        //<editor-fold desc="DIETA">
        $selected_dieta_list = $this->req->dieta_erzekenyseg_lista ?: [];
        $dieta_list = Dieta::where('megnevezes', '<>', '')->getQuery()->getArray();
        //</editor-fold>

        //<editor-fold desc="SEGITO_MUNKA">
        $selected_segito_munka_list = $this->req->segito_munka_lista ?: [];
        $segito_munka_list = Segitomunka::where('alias', '<>', '')->getQuery()->getArray();
        //</editor-fold>

        return new ControllerResponse(
            'tabor.jelentkezes.jelentkezes',
            compact(
                "tabor_list",
                "tabor_id",
                "tabor_napok_list",
                "selected_tabor_napok_list",
                'selected_tabor_etkezes_list',
                'tabor_etkezes_list',
                "dieta_list",
                "selected_dieta_list",
                "segito_munka_list",
                "selected_segito_munka_list",
                "aszf"
            ));
    }

    /**
     * @return Jelentkezo|null
     * @throws ReflectionException
     * @throws ControllerException
     */
    private function _jelentkezesRogzitese(): ?Jelentkezo
    {
        if ($this->req->method() !== 'POST') {
            return null;
        }
        $dietaRepo = DietaRepository::getInstance();
        $dietak = $dietaRepo->ujErtekSzovegbol($this->req->dieta_erzekenyseg_tovabbi ?: '');
        $segitoRepo = SegitomunkaRepository::getInstance();
        $munkak = $segitoRepo->ujErtekSzovegbol($this->req->segito_munka_tovabbi ?: '');

        $userRepo = UserRepository::getInstance();
        try {
            DB::beginTransaction();
            $tabor = Tabor::findOrFail($this->req->tabor_id);
            $user = $userRepo->getOrRegister($this->req->email, $this->req->nev_kereszt, $this->req->szuletesnap, $uj);

            $data = [
                'ID_tabor' => $tabor->ID,
                'nev_elotag' => $this->req->nev_elotag,
                'nev_vezetek' => $this->req->nev_vezetek,
                'nev_kereszt' => $this->req->nev_kereszt,
                'email' => $this->req->email,
                'szuletesnap' => $this->req->szuletesnap,
                //'nem' => $this->req->nem,
                'szallas_kulcsszo' => $this->req->szallas_kulcsszo,
                'ID_aszf' => $tabor->ID_aszf,
                'ID_user' => $user->id,
                'MOD_user' => $this->getAuthUser()->id,
            ];
            if (Jelentkezo::where($data)->first() !== null) {
                throw new ControllerException('A jelentkezés már létezik');
            }
            $jelentkezo = Jelentkezo::create($data);

            //<editor-fold desc="DIETA CSATOLÁS">
            $kijeloltDietaIDk = array_merge(
                $this->req->dieta_erzekenyseg_lista,
                array_column($dietak, 'ID')
            );
            $jelentkezoDietaInsertable = [];
            foreach ($kijeloltDietaIDk as $k => $ID) {
                $jelentkezoDietaInsertable[] = [
                    'ID_dieta' => $ID,
                    'ID_jelentkezo' => $jelentkezo->ID
                ];
            }
            JelentkezoDieta::insert($jelentkezoDietaInsertable);
            //</editor-fold>

            //<editor-fold desc="MUNKA CSATOLÁS">
            $kijeloltMunkaIDk = array_merge(
                array_column(
                    array_map(function ($val) {
                        return \App\Models\Segitomunka::where('alias', '=', $val)->firstOrFail();
                    }, $this->req->segito_munka_lista),
                    'ID'
                ),
                array_column($munkak, 'ID')
            );
            $jelentkezoMunkaInsertable = [];
            foreach ($kijeloltMunkaIDk as $k => $ID) {
                $jelentkezoMunkaInsertable[] = [
                    'ID_segito_munka' => $ID,
                    'ID_jelentkezo' => $jelentkezo->ID
                ];
            }
            JelentkezoSegitomunka::insert($jelentkezoMunkaInsertable);
            //</editor-fold>

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $jelentkezo;
    }

    private function _jelentkezesSikeresVisszajelzes(Jelentkezo $jelentkezo): ControllerResponse
    {
        //jelentkezés sikeres volt, email küldés + display a frontnak
        return new ControllerResponse(
            'tabor.jelentkezes.jelentkezes_sikeres',
        );
    }

}
