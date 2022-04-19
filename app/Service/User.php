<?php

namespace App\Service;

use App\Models\Jelentkezo;
use App\Repositories\JelentkezoRepository;

/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2018.09.01.
 * Time: 18:58
 */
class MainUser extends Singleton {
    protected $ID, $uName, $uLevel;
    /** @var Jelentkezo */
    protected $jelentkezo;
    /** @var JelentkezoRepository */
    protected $jelentkezoRepository;

    /**
     * @param $taborId
     * @param $felhasznalonev
     * @param $jelszo
     * @return bool success
     */
    public function login($taborId, $felhasznalonev, $jelszo):bool {
        $res = (new Jelentkezo($taborId))->azonosit($taborId, $felhasznalonev, $jelszo);
        if (!empty($res)) {
            //$this->jelentkezo
            list($this->ID, $this->uName, $this->uLevel) = array_values($res);
        }
    }

    public function logout() {
        $this->removeClassSessionData();
    }

    public function isAdmin() {
        return $this->uLevel >= 4;
    }

    public function hasAccess($lvl) {
        return $this->uLevel >= $lvl;
    }

    /**
     * @throws \ReflectionException
     */
    protected function Load() {
        $this->jelentkezoRepository=JelentkezoRepository::getInstance();
        $udata = &$this->getClassSessionReference();
        $this->ID = &$udata['ID'];
        $this->uName = &$udata['felhasznalonev'];
        $this->uLevel = &$udata['jogszint'];
        if (!$this->isLoggedIn() && in_array(array_values(array_filter(explode("/", $_SERVER['REQUEST_URI'])))[0], array('admin', 'felhasznalo'))) {
            MainTemplate::getInstance()->redirect('belepes', 'felhasznalo');
        }
    }

    public function isLoggedIn() {
        return !is_null($this->jelentkezo);
    }
}