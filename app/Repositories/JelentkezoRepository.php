<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Models\Jelentkezo;

class JelentkezoRepository extends MainRepository
{
    /** @var string|Jelentkezo */
    protected $model = Jelentkezo::class;

    public function letezikE($nev_elotag, $nev_vezetek, $nev_kereszt, $email, $taborId, $szuletesnap): bool
    {
        return !is_null(
            $this->model::where('nev_elotag', "=", $nev_elotag)
                ->where("nev_vezetek", "=", $nev_vezetek)
                ->where("nev_kereszt", "=", $nev_kereszt)
                ->where("email", "=", $email)
                ->where("taborId", "=", $taborId)
                ->where("szuletesnap", "=", $szuletesnap)
                ->get()
        );
    }

    public function azonosit($taborId, $felhasznalonev, $jelszo)
    {
        return $this->model::/*select([
            "ID", "felhasznalonev", "jogszint"
        ])
            ->*/
        where("taborId", "=", $taborId)
            ->where("felhasznalonev", "=", $felhasznalonev)
            ->where("jelszo", "=", $this->model->encryptPw($jelszo))
            ->get();
    }
}